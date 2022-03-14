<?php

namespace App\Domains\Notification;

use App\Domains\Core\Repository;
use App\Models\Notification\Notification;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository extends Repository
{
    public function __construct(Notification $notifcation)
    {
        parent::__construct($notifcation);
    }

    public function newModel()
    {
        return new Notification();
    }

    public function fill(array $data, Model $model)
    {
        $model->user_id = $data['user_id'];
        $model->message = $data['message'];
        $model->is_read = $data['is_read'];
        $model->url = $data['url'];
        return $model;
    }

    public function readById($id)
    {
        $notification = $this->getById($id);
        return $this->update($notification->id, [
            'user_id' => $notification->user_id,
            'message' => $notification->message,
            'is_read' => 1,
            'url' => $notification->url,
        ]);
    }

    public function readAll($user)
    {
        $notifcations = $this->model
            ->where('user_id', $user)
            ->where('is_read', 0)
            ->get();
        foreach ($notifcations as $notifcation) {
            $notifcation->is_read = 1;
            $notifcation->save();
        }
    }
}
