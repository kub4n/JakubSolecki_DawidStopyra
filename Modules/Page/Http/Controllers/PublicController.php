<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Page\Entities\Page;
use Modules\Page\Repositories\PageRepository;
use Modules\User\Repositories\UserRepository;
use Modules\Blog\Entities\Post;
use Modules\Tag\Entities\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DB;

class PublicController extends BasePublicController
{
    /**
     * @var PageRepository
     */
    private $page;
    /**
     * @var Application
     */
    private $app;
    protected $user;
    public function __construct(PageRepository $page, Application $app, UserRepository $user)
    {
        parent::__construct();
        $this->page = $page;
        $this->app = $app;
        $this->user = $user;
    }

    /**
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function uri($slug)
    {
        $page = $this->findPageForSlug($slug);

        $this->throw404IfNotFound($page);

        $template = $this->getTemplateForPage($page);

        return view($template, compact('page'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function homepage()
    {
        $page = $this->page->findHomepage();

        $this->throw404IfNotFound($page);

        $template = $this->getTemplateForPage($page);
        $user = $this->auth->user();
        return view($template, compact('page','user'));
    }
    public function search(Request $request)
    {

        if (!empty($request->input('searchword'))) {
            $searchWorld = strip_tags($request->input('searchword'));

            $checkposts = array();

            $allResults[0]['/apartamenty/lista/'] = Post::with(['translations', 'files'])->whereHas('translations', function ($query) {
                $query->where('title', 'like', '%' . strip_tags(request()->searchword) . '%')->orWhere('content', 'like', '%' . strip_tags(request()->searchword) . '%');
            })->get();

            foreach($allResults[0]['/apartamenty/lista/'] as $post)
            {
                $checkposts[] = $post->id;
            }

            $tags = Tag::with(['translations'])->whereHas('translations', function ($query) {
                $query->where('name', 'like', '%' . strip_tags(request()->searchword) . '%');
            })->get();

            foreach($tags as $tag)
            {
                $i=1;
                $posts_id = DB::select("select taggable_id from tag__tagged where tag_id = $tag->id");
                foreach ( $posts_id as $post_id )
                {
                    if (in_array($post_id->taggable_id, $checkposts))
                        continue;
                    $allResults[$i]['/apartamenty/lista/'] = Post::where('id', $post_id->taggable_id)->get();
                    $i++;
                }
            }
            return view('search', compact('allResults'));
        }
    }
    /**
     * Find a page for the given slug.
     * The slug can be a 'composed' slug via the Menu
     * @param string $slug
     * @return Page
     */
    private function findPageForSlug($slug)
    {
        $menuItem = app(MenuItemRepository::class)->findByUriInLanguage($slug, locale());

        if ($menuItem) {
            return $this->page->find($menuItem->page_id);
        }

        return $this->page->findBySlug($slug);
    }

    /**
     * Return the template for the given page
     * or the default template if none found
     * @param $page
     * @return string
     */
    private function getTemplateForPage($page)
    {
        return (view()->exists($page->template)) ? $page->template : 'default';
    }

    /**
     * Throw a 404 error page if the given page is not found
     * @param $page
     */
    private function throw404IfNotFound($page)
    {
        if (is_null($page)) {
            $this->app->abort('404');
        }
    }
}
