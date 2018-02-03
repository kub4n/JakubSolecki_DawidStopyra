<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Support\Facades\App;
use Modules\Blog\Repositories\PostRepository;
use Modules\Blog\Repositories\ReservationRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CreateReservationRequest;

class PublicController extends BasePublicController
{
    /**
     * @var PostRepository
     */
    private $post;

    public function __construct(PostRepository $post, ReservationRepository $reservation)
    {
        parent::__construct();
        $this->post = $post;
        $this->reservation = $reservation;
    }

    public function index()
    {
        $posts = $this->post->allTranslatedIn(App::getLocale());

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $user = Auth::id();
        $post = $this->post->findBySlug($slug);

        return view('blog.show', compact('post', 'user','users'));
    }
    public function reserve(CreateReservationRequest $request, $post)
    {
        $user = Auth::id();
        $request->request->add(['post_id' => $post->id]);
        $request->request->add(['user_id' => $user]);
        $request->request->add(['owner_id' => $post->user_id]);
        $request->request->add(['status' => 0]);
        $this->reservation->create($request->all());

        return redirect('backend/blog/reservations');
    }
}
