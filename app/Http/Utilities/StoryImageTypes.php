<?php
namespace emutoday\Http\Utilities;

class StoryImageTypes
{
	protected static $storyimagetypes = [
		"Main Story Image"                             => "imagemain",
		"Small Story Image"                            => "imagesmall",
		"Hero Story Image"                             => "imagehero"
	];

	public static function all()
	{
		return static::$storyimagetypes;
	}

}
