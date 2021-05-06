<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParentProfile;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id', 'content', 'type', 'read', 'student_profile_id', 'transcript_id'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\ParentProfile', 'parent_profile_id', 'id');
    }

    static public function getParentNotifications()
    {
        try {
            $notifications = Notification::where('parent_profile_id', ParentProfile::getParentId())
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get();

            $data = [];
            foreach ($notifications as $notification) {
                switch ($notification->type) {
                    case 'graduation_approved':
                        $link = ['name' => 'View', 'url' => route('graduation.apply')];
                        break;
                    case 'transcript_submitted_k8':
                        $link = ['name' => 'Preview', 'url' => route('preview.transcript', [$notification->student_profile_id, $notification->transcript_id])];
                        break;
                    case 'transcript_submitted_9_12':
                        $link = ['name' => 'Preview', 'url' => route('preview.transcript9_12', [$notification->student_profile_id, $notification->transcript_id])];
                        break;
                    default:
                        $link = null;
                        break;
                }

                array_push($data, ['content' => $notification->content, 'read' =>  $notification->content, 'link' => $link]);
            }

            return response()->json(['status' => 'success', 'notifications' => $data]);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
