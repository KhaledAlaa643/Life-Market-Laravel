<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $notifications = $user->notifications()->get();

        return ($notifications);
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $notification = $user->notifications()->where('id', $request->id)->first();

        if (!$notification) {
            return response()->json(['error' => 'Notification not found.'], 404);
        }



        $notification->markAsRead();
        $notification->read_at = now(); // Set the read_at field explicitly
        $notification->save(); // Save the change to the database

        return new NotificationResource($notification);
    }

    public function getUnreadCount(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'unread_count' => $unreadCount,
        ]);
    }
}
