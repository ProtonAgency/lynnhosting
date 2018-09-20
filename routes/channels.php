<?php

use App\Container;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('container.{containerName}', function ($user, $containerName) {
    return Container::where('user_id', '=', $user->id)->where('name', '=', $containerName)->get()->first() !== null;
});