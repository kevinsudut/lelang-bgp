<?php

namespace App\Http\Controllers\Notification;

use App\Domains\Notification\NotificationRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\ReadNotificationRequest;
use Illuminate\Support\Facades\Gate;

class NotificationController extends Controller
{
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $user = auth()->user();

        $notifications = $this->notificationRepository->paginateWhereSortBy(
            ['user_id', '=', $user->id],
            'created_at',
            'desc',
            9
        );

        return view('notification.index', compact('notifications'));
    }

    public function read(ReadNotificationRequest $request)
    {
        $notification = $this->notificationRepository->getById($request->get('id'));

        if (Gate::allows('read-notification', $notification)) {
            $this->notificationRepository->readById($request->get('id'));
            return redirect(url($notification->url));
        }

        return redirect('/')->withErrors('401 UNAUTHORIZED');
    }

    public function readAll()
    {
        $this->notificationRepository->readAll(auth()->user()->id);
        return redirect()->back();
    }
}
