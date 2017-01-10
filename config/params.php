<?php

return [
	'adminEmail' => 'zipaphoto@gmail.com',
    'languages' => [
        'ru' => [
	        'language' => 'Russian',
	        'flag' => '/bootstrap/img/RussiaFlag.png',
	    ],
        'en' => [
	        'language' => 'English',
	        'flag' => '/bootstrap/img/langen.png',
	    ],
        'fr' => [
	        'language' => 'French',
	        'flag' => '/bootstrap/img/FranceFlag.png',
        ],
        'sr' => [
	        'language' => 'Serbian',
	        'flag' => '/bootstrap/img/langsr.png',
        ],
	],
    'app_name' => 'ZipaPhoto',
	'errorEmail' => 'tumenko.slavisa@gmail.com',
	'userInfoEmail' => 'noreplay@photoboro.com',
	'originalImageFolder' => 'protected/origimages/',
	'customImageFolder' => 'protected/customdownload/',
	'previewImageFolder' => '/images/',
	'bannerImageFolder' => '/banners/',
	'thumbImageFolder' => '/thumbs/',
	'sliderImageFolder' =>'images/slider/',
	'previewImageWidth' => '800', //create preview image with this width value
	'thumbImageWidth' => '350', //create preview image with this width value
	'maxImageSize' => 10 * 1024 * 1024, //image size limit in bytes
	'imageDimensionMin' => 100, //minimum fow width and height
	'imageDimensionMax' => 30000, //maximum fow width and height
	'allowedImageTypes' => array('image/jpeg'), //validation
	'allowedBannerTypes' => array('image/jpeg'), //validation
	'allowedSliderTypes' => array('image/jpeg'), //validation
	'waterMarkPath' => 'images/watermark.png', //watermark image
	'thumbWaterMarkPath' => 'images/watermark_small.png', //small watermark image
	'errorLogFile' => 'errorLog.txt',
	'defaultTranslationLanguage' => 1,
	'slash'=>'',
	'defaultPhotoPrice'=>'20.00',


	'agency' => [
		'about_us' => [
			'menu' => Yii::t('app','About us'),
			'url' => '/site/agency/1',
		],
		'conditions' => [
			'menu' => Yii::t('app','Conditions of use'),
			'url' => '/site/agency/2',
		],
		'contracts' => [
			'menu' => Yii::t('app','Contracts'),
			'url' => '/site/agency/3',
		],
		'site_frends' => [
			'menu' => Yii::t('app','Friends site'),
			'url' => '/site/agency/4',
		],

	],

];


