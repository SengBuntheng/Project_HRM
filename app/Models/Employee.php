<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'profile_photo_path',
        'position',
        'position_id',
        'department_id',
        'department',
        'salary',
        'hire_date',
        'status',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'salary' => 'decimal:2',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }

        $first = $this->first_name ? substr($this->first_name, 0, 1) : '';
        $last = $this->last_name ? substr($this->last_name, 0, 1) : '';
        $initials = strtoupper(trim($first . $last));
        if ($initials === '') {
            $initials = '?';
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="160" height="160">'
            . '<rect width="100%" height="100%" fill="#6c757d"/>'
            . '<text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" '
            . 'font-family="Arial, sans-serif" font-size="64" fill="#ffffff">'
            . $initials
            . '</text>'
            . '</svg>';

        return 'data:image/svg+xml;utf8,' . rawurlencode($svg);
    }

    /**
     * Get the position that the employee belongs to
     */
    public function positionRelation()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * Get the department that the employee belongs to
     */
    public function departmentRelation()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }
}