<?php

namespace App\Http\Resources;

use App\Models\Channel;
use App\Models\Post;
use App\Models\User;
use Date;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post
 * @property int $id
 * @property string $status
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property bool $is_nsfw
 * @property bool $is_spoiler
 * @property bool $is_locked
 * @property bool $is_pinned
 * @property Date $created_at
 * @property Date $updated_at
 * @property User $user
 * @property Channel $channel
 */
class PostResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_nsfw' => $this->is_nsfw,
            'is_spoiler' => $this->is_spoiler,
            'is_locked' => $this->is_locked,
            'is_pinned' => $this->is_pinned,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => UserResource::make($this->whenLoaded('user')),
            'channel' => ChannelResource::make($this->whenLoaded('channel')),
        ];
    }
}
