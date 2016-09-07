<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Mediafile extends Model
{
    protected $fillable = [	'type',
                            'group',

                            'path',
                            'name',
                            'ext',
                            'filename',
                            'headline',

                            'caption',
                            'teaser',

                            'link',
                            'link_text',

                            'note',
                            'is_active',
                            'mediatype_id'

    ];
    public function delete()
    {
        \File::delete([
            $this->path .$this->name.'.'.$this->ext
            //, $this->path . 'thumbnails/' . 'thumb-' . $this->name.'.'.$this->ext
        ]);
        parent::delete();
    }
    public function getFullPath(){
        return $this->path . $this->name . '.' . $this->ext;
    }
    public function getMediaNameAttribute(){
        return $this->name . '.' . $this->ext;
    }
    public function events()
    {
        return $this->hasMany('emutoday\Event');
    }
    public function mediatype()
    {
        return $this->belongsTo('emutoday\Mediatype','mediatype_id');
    }

    public function magazines()
    {
        return $this->belongsToMany('emutoday\Magazine');
    }

    public function users()
    {
        return $this->belongsToMany('emutoday\User');
    }

    public function scopeOfType($query, $type)
    {
            return $query->where('group', $type);
    }
}
