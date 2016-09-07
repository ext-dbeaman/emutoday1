<?php
/*
*************
The ORDER of ROUTES is critical
*/
use emutoday\Building;
use emutoday\Event;
use emutoday\Category;
use emutoday\Tag;
use emutoday\MiniCalendar;
use Illuminate\Support\Facades\Input;

Route::group(['prefix' => 'api'], function() {

    Route::get('active-categories/{year?}/{month?}/{day?}','Api\CategoriesController@activeCategories');

    Route::get('calendar/month/{year?}/{month?}/{day?}','Api\CalendarController@eventsInMonth');
    Route::get('calendar/events/{year?}/{month?}/{day?}','Api\CalendarController@eventsByDay');

    Route::get('zbuildings', function() {
        $text = Input::get('q');
        return Building::likeSearch('name', $text)->get();
        //return Building::ofMapType('illustrated')->get();
    });
    Route::get('buildinglist', function() {
        $text = Input::get('q');
        return Building::likeSearch('name', $text)->select('name')->get();
        //return Building::ofMapType('illustrated')->get();
    });
    Route::get('categorylist', function() {
        $text = Input::get('q');
        return Category::likeSearch('category', $text)->select('category', 'id as value')->get();
        //return Building::ofMapType('illustrated')->get();
    });
    Route::get('taglist', function() {

        return Tag::select('name', 'id as value')->get();
    });
    Route::get('minicalslist', function() {

        return MiniCalendar::select('calendar', 'id as value')->get();
    });
    // Route::get('taglist', function() {
    //     $text = Input::get('q');
    //     return Tag::likeSearch('name', $text)->select('name', 'id')->get();
    // });

    Route::get('minicals', function() {
        $text = Input::get('q');
        return MiniCalendar::likeSearch('calendar', $text)->select('calendar','id as value')->get();
        //return Building::ofMapType('illustrated')->get();
    });

    /**
     * Routes for Bugz
     */
    Route::get('bugz/listall', ['as' => 'api.bugz.listall', 'uses' => 'Api\BugzController@listall']);
    Route::patch('bugz/updateItem/{id}', 'Api\BugzController@updateItem');
    Route::resource('bugz', 'Api\BugzController');

    Route::get('zevent-catgeories', function() {
        // $cats = \emutoday\Category::lists('category', 'id');
        return \emutoday\Category::all();
        //return Building::ofMapType('illustrated')->get();
    });

    Route::get('list-event-categories', ['uses'=> 'Api\EventController@listEventCategories']);

    Route::get('buildings', ['uses'=> 'Api\EventController@buildings']);

    Route::patch('event/updateItem/{event}', 'Api\EventController@updateItem');
    Route::post('event/addMediaFile/{event}', 'Api\EventController@addMediaFile');

    Route::get('event/queueload', ['as' => 'api.event.queueload', 'uses' => 'Api\EventController@queueLoad']);
    Route::get('event/otherItems', ['as' => 'api.event.otheritems', 'uses' => 'Api\EventController@otherItems']);
    Route::get('event/unapprovedItems', ['as' => 'api.event.unapproveditems', 'uses' => 'Api\EventController@unapprovedItems']);
    Route::get('event/approvedItems', ['as' => 'api.event.approveditems', 'uses' => 'Api\EventController@approvedItems']);

    Route::get('event', ['as' => 'api.event', 'uses' => 'Api\EventController@index']);
    Route::resource('event', 'Api\EventController');

    Route::get('events/{id}/categories', 'Api\CategoriesController@index');
    Route::resource('categories', 'Api\CategoriesController', ['only'=>['index', 'show']] );

    Route::resource('minicalendars', 'Api\MiniCalendarsController', ['only'=>['index', 'show']] );
    // Route::get('buildings', 'Api\BuildingController', ['only'=>['index']]);

    Route::get('magazine/articles', ['as'=> 'api.magazine.articles', 'uses'=> 'Api\StoryController@articles']);

    Route::get('story/queueload/{stype}', ['as'=> 'api_story_queueload', 'uses'=> 'Api\StoryController@queueload']);
    Route::get('story/appLoad', ['as' => 'api.story.appLoad', 'uses' => 'Api\StoryController@appLoad']);
    Route::get('story/listapproved', ['as' => 'api.story.listapproved', 'uses' => 'Api\StoryController@listApproved']);
    Route::get('story/{stype}', ['as' => 'api.story.listType', 'uses' => 'Api\StoryController@listType']);
    Route::get('story', ['as' => 'api.story', 'uses' => 'Api\StoryController@index']);
    Route::post('story/delete', ['as' => 'api.story.delete', 'uses' => 'Api\StoryController@delete']);

    Route::patch('story/updateQueue', ['as' => 'story_update_queue', 'uses' => 'Api\StoryController@updateQueue']);
    Route::patch('story/updateItem/{story}', ['as' => 'story_update_item', 'uses' => 'Api\StoryController@updateItem']);


    Route::resource('story', 'Api\StoryController');
    Route::resource('author', 'Api\AuthorController');
    //  Route::get('announcement', ['as' => 'api.announcement', 'uses' => 'Api\AnnouncementController@index']);
    //  Route::get('announcement/{announcement}', ['as' => 'api_announcement_get', 'uses' => 'Api\AnnouncementController@edit']);
    Route::get('announcement/queueload', ['as' => 'api.announcement.queueload', 'uses' => 'Api\AnnouncementController@queueLoad']);

    Route::get('announcement/listall', ['as' => 'api.announcement.listall', 'uses' => 'Api\AnnouncementController@listall']);

    Route::get('announcement/unapprovedItems', ['as' => 'api.announcement.unapprovedItems', 'uses' => 'Api\AnnouncementController@unapprovedItems']);
    Route::get('announcement/approvedItems', ['as' => 'api.announcement.approvedItems', 'uses' => 'Api\AnnouncementController@approvedItems']);

    Route::patch('announcement/archiveItem/{id}', ['as' => 'api_announcement_archiveItem', 'uses' => 'Api\AnnouncementController@archiveItem']);
    Route::patch('announcement/updateItem/{id}', 'Api\AnnouncementController@updateItem');


    Route::resource('announcement', 'Api\AnnouncementController');

    Route::get('magazine', ['as' => 'api.magazine', 'uses' => 'Api\MagazineController@index']);

    Route::patch('magazine/saveas/{id}', 'Api\MagazineController@saveAs');
    Route::resource('magazine', 'Api\MagazineController');

    Route::get('page/appLoad', ['as' => 'api.page.appload', 'uses' => 'Api\PageController@appLoad']);
    Route::get('page', ['as' => 'api.page', 'uses' => 'Api\PageController@index']);
    Route::post('page/delete', ['as' => 'api.page.delete', 'uses' => 'Api\PageController@delete']);
    Route::patch('page/saveas/{id}', 'Api\PageController@saveAs');

    Route::resource('page', 'Api\PageController');

});


Route::group(['middleware' => ['web']], function() {

    Route::controller('auth/password', 'Auth\PasswordController', [
        'getEmail' => 'auth.password.email',
        'getReset' => 'auth.password.reset'
    ]);

    Route::controller('auth', 'Auth\AuthController', [
        'getLogin' => 'auth.login',
        'getLogout' => 'auth.logout'
    ]);

    // Route::get('imagecache', function()
    // {
    // 	$img = Image::make('img39_hero.jpg');
    // 	return $img->response();
    // });

    Route::get('/', ['as' => '/', 'uses' => 'MainController@index']);

    Route::group(['prefix' => 'emu-today'], function() {


        Route::get('story/{id?}', 'EmuToday\StoryController@index');
        Route::get('news/{id?}', 'EmuToday\StoryController@index');
        Route::get('student/{id?}', 'EmuToday\StudentController@index');
        Route::get('calendar/{year?}/{month?}/{day?}', 'EmuToday\CalendarController@index');


        // Route::get('magazine/index', 'EmuToday\MagazineController@index');
        Route::get('magazine/article/{id?}', 'EmuToday\MagazineController@article');
        Route::get('magazine/issue/{year?}/{season?}', 'EmuToday\MagazineController@issue');
        Route::get('magazine/{year?}/{season?}', 'EmuToday\MagazineController@index');

        Route::get('announcement/create', 'EmuToday\AnnouncementController@create');
        Route::get('announcement/{id?}', 'EmuToday\AnnouncementController@index');

        Route::resource('announcement', 'EmuToday\AnnouncementController');

        Route::get('formvue', function () {
            return view('public.event.formvue');
        });

        Route::get('event/{event}/edit', ['as' => 'emutoday_event_edit', 'uses' => 'EmuToday\EventController@edit']);
        // Route::get('event/create', ['as' => 'emutoday_event_create', 'uses' => 'EmuToday\EventController@create']);


        Route::resource('event', 'EmuToday\EventController');

        Route::get('search','MainController@search' );

        Route::get('hub', 'MainController@index');


        // Route::get('events', function() {
        //     return view('public.event.index');
        //   });
    });

    //watch out for match anything ROUTES
    Route::group(['prefix' => 'preview' ], function()
    {
        Route::get('page/{page}/', ['as' => 'preview_hub', 'uses' => 'PreviewController@hub']);
        Route::get('magazine/{magazine}/', ['as' => 'preview_magazine', 'uses' => 'PreviewController@magazine']);

        Route::get('magazine/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);

        Route::get('story/{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
        Route::get('{stype}/{story}/', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);


    });

    Route::group(['prefix' => 'admin' ], function()
    {

        Route::get('delete', function() {
            return back();
        });
        Route::post('user/{user}/addMediafileUser', ['as' => 'store_mediafile_user', 'uses' => 'Admin\MediafileController@addMediafileUser']);
        Route::post('user/{user}/updateMediafileUser', ['as' => 'update_mediafile_user', 'uses' => 'Admin\MediafileController@updateMediafileUser']);
        Route::delete('user/{user}/removeMediafileUser', ['as' => 'remove_mediafile_user', 'uses' => 'Admin\MediafileController@removeMediafileUser']);

        Route::get('users/{users}/confirm', ['as' => 'admin.users.confirm', 'uses' => 'Admin\UsersController@confirm']);
        Route::resource('users', 'Admin\UsersController');


        Route::get('magazine/{magazine}/edit', ['as' => 'admin_magazine_edit', 'uses' => 'Admin\MagazineController@edit']);

        Route::get('magazine/article/queue', ['as'=> 'admin_magazine_article_queue', 'uses'=> 'Admin\StoryController@queueArticle']);
        // Route::get('magazine/article/{story}/edit', ['as' => 'admin_magazine_article_edit', 'uses' => 'Admin\StoryController@edit']);


        Route::get('magazine/{stype}/{story}/edit', ['as' => 'admin_magazine_article_edit', 'uses' => 'Admin\StoryTypeController@storyTypeEdit']);



        Route::get('magazine/{magazine}/confirm', ['as' => 'admin.magazine.confirm', 'uses' => 'Admin\MagazineController@confirm']);
        Route::post('magazine/{magazine}/addCoverImage', ['as' => 'store_magazine_cover', 'uses' => 'Admin\MagazineController@addCoverImage']);

        Route::put('magazine/{mediafile}/updateCoverImage/', ['as' => 'update_magazine_cover', 'uses' => 'Admin\MagazineController@updateCoverImage']);

        Route::post('magazine/delete', ['as' => 'admin_magazine_delete', 'uses' => 'Admin\MagazineController@delete'] );

        Route::resource('magazine', 'Admin\MagazineController');



        // Route::get('story/setup/{stype}/', ['as' => 'admin_story_setup', 'uses' => 'Admin\StoryController@setup']);
        // Route::get('story/indexList', ['as' => 'admin.story.indexList', 'uses' => 'Admin\StoryController@indexList']);

        /**
         *
         * Routes related to stories organized by storyType
         *
         * (story/{stype} or magazine/article)
         */

        Route::put('story/{id}/updateFromPreview', ['as'=> 'admin_story_updatefrompreview', 'uses'=> 'Admin\StoryController@updateFromPreview']);
        Route::get('story/app', ['as' => 'admin_story_app', 'uses' => 'Admin\StoryController@app']);

        Route::get('story/queue', ['as' => 'admin_story_queue', 'uses' => 'Admin\StoryController@queue']);
        Route::get('story/{stype}/queue', ['as' => 'admin_storytype_queue', 'uses' => 'Admin\StoryController@queueType']);

        Route::get('magazine/article/setup', ['as' => 'admin_magazine_article_setup', 'uses' => 'Admin\StoryTypeController@articleSetup']);

        Route::get('story/{stype}', ['as' => 'admin_storytype_list', 'uses' => 'Admin\StoryTypeController@list']);

        Route::get('story/{stype}/setup', ['as' => 'admin_storytype_setup', 'uses' => 'Admin\StoryTypeController@storyTypeSetUp']);
        Route::get('story/{stype}/{story}/edit', ['as' => 'admin_storytype_edit', 'uses' => 'Admin\StoryTypeController@storyTypeEdit']);

        Route::post('story/{stype}/{story}/addNewStoryImage','Admin\StoryController@addNewStoryImage');

        Route::get('story/{story}/confirm', ['as' => 'admin.story.confirm', 'uses' => 'Admin\StoryController@confirm']);

        Route::post('story/{id}/addnewimage','Admin\StoryController@addNewImage');
        Route::post('story/{id}/addimage', 'Admin\StoryController@addImage');
        Route::post('story/{id}/promoteStory', 'Admin\StoryController@promoteStory');
        Route::post('story/imageUpload',[
            'as' => 'admin.story.imageupload',
            'uses' => 'Admin\StoryController@imageUpload'
        ]);

        Route::get('story/imageBrowse',[
            'as' => 'admin.story.imagebrowse',
            'uses' => 'Admin\StoryController@imageBrowse'
        ]);

        Route::resource('story', 'Admin\StoryController');


        Route::get('announcement/app', ['as' => 'admin.announcement.app', 'uses' => 'Admin\AnnouncementController@appload']);
        Route::get('announcement/queue', ['as' => 'admin.announcement.queue', 'uses' => 'Admin\AnnouncementController@queue']);

        Route::get('announcement/{announcement}/confirm', ['as' => 'admin.announcement.confirm', 'uses' => 'Admin\AnnouncementController@confirm']);
        Route::post('announcement/delete', ['as' => 'admin_announcement_delete', 'uses' => 'Admin\AnnouncementController@delete'] );
        Route::resource('announcement', 'Admin\AnnouncementController');

        Route::get('storyimages/{storyimages}/confirm', ['as' => 'admin.storyimages.confirm', 'uses' => 'Admin\StoryImageController@confirm']);
        Route::resource('storyimages', 'Admin\StoryImageController');

        Route::get('page/app', ['as' => 'admin.page.app', 'uses' => 'Admin\PageController@appLoad']);

        Route::get('page/{page}/edit', ['as' => 'admin_page_edit', 'uses' => 'Admin\PageController@edit']);

        Route::get('page/{page}/confirm', ['as' => 'admin.page.confirm', 'uses' => 'Admin\PageController@confirm']);
        Route::post('page/delete', ['as' => 'admin_page_delete', 'uses' => 'Admin\PageController@delete'] );

        Route::resource('page', 'Admin\PageController');

        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

        Route::get('event/queue', ['as' => 'admin.event.queue', 'uses' => 'Admin\EventController@queue']);

        Route::get('event/{event}/confirm', ['as' => 'admin.event.confirm', 'uses' => 'Admin\EventController@confirm']);
        Route::resource('event', 'Admin\EventController');

        Route::resource('mediafile', 'Admin\MediafileController');


        Route::resource('role', 'Admin\RoleController');

        Route::resource('permission', 'Admin\PermissionController');

        Route::resource('mediatype', 'Admin\MediatypeController');

        Route::resource('imagetype', 'Admin\ImagetypeController');

        Route::get('queue', function() {
            return view('admin.queue');
        });

        Route::get('bugz/app', ['as' => 'admin.bugz.app', 'uses' => 'Admin\BugzController@appload']);

        Route::resource('bugz', 'Admin\BugzController');
        Route::get('twitter', 'Admin\TwitterController@index');
        Route::post('approve-tweets', 'Admin\TwitterController@store');

    });


});
