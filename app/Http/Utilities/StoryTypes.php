<?php
namespace emutoday\Http\Utilities;

class StoryTypes
{
	protected static $storytypes = [
		"Basic Story"                                  => "news",
		"Story"                                   => "story",
		"Student Profile"                              => "student",
		"Magazine Article"                               => "article"
	];

	public static function all()
	{
		return static::$storytypes;
	}

}
