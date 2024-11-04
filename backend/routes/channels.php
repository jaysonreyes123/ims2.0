<?php

use App\Events\Test;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('data.event', function(){
    return true;
});

Broadcast::channel('rg-event', function(){
    return true;
});

Broadcast::channel('wl-event', function(){
    return true;
});

Broadcast::channel('single-chart-event', function(){
    return true;
});

Broadcast::channel('incident-event', function(){
    return true;
});

Broadcast::channel('notification-event', function(){
    return true;
});
Broadcast::channel('rgwl-event', function(){
    return true;
});