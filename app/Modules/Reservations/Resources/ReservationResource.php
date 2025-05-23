<?php

namespace App\Modules\Reservations\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ReservationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->sort ?? null) {
            case '2':
                $status = __('api.reservations.status.last');
                $status_id = 2;
                $remainingInSeconds = 0;
                break;
            case '1':
                $status = __('api.reservations.status.upcoming');
                $status_id = 1;
                $remainingInSeconds = -1;
                break;
            case '0':
                $status = __('api.reservations.status.current');
                $status_id = 0;
                $remainingInSeconds = $this->end_datetime ? $this->end_datetime->diffInSeconds(now()) : 0;
                break;
            default:
                $status = 'unknown';
                $status_id = null;
                $remainingInSeconds = 0;
                break;
        }


        return [
            'id' => $this->id,
            'sort' => $this->when(isset($this->sort), $this->sort),
            'doctor' => [
                'id' => $this->doctor->id,
                'name' => $this->doctor->user->name,
                'avatar' => url($this->doctor->user->avatar),
                'comet_chat_uid' => $this->doctor->user->comet_chat_uid,
            ],
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'avatar' => url($this->user->avatar ?? '/'),
                'comet_chat_uid' => $this->user->comet_chat_uid ?? null,
            ],
            'service' => [
                'id' => $this->service->id,
                'name' => $this->service->name,
                'image' => url($this->service->image)
            ],
            'date' => $this->date,
            // 'server_time'       => now()->format('H'), // for bugging
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $status,
            'status_id' => $status_id,
            'remining' => $remainingInSeconds,
            'notes' => $this->notes,
            'order_status' => [
                'id' => $this->orderStatus->id,
                'code' => $this->orderStatus->code,
                'title' => $this->orderStatus->title,
            ],
        ];
    }
}
