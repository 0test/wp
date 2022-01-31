<?php
include_once("php/lib/bootstrap.php");
include_once("php/lib/wp.php");


define('MODX_API_MODE', true);
define('IN_MANAGER_MODE', true);

/*
include_once(__DIR__ . "../../index.php");
$modx->db->connect();
if (empty($modx->config)) {
	$modx->getSettings();
}
*/
$xml = processXML(__DIR__ . '/posts.xml');

$allPosts = [];
$allCats = [];
$allTags = [];
$allFiles = [];


$cats = [
	'7' => 'obshhestvo',
	'8' => 'uncategorized',
	'9' => 'vospitanie',
	'10' =>  'transport',
	'11' =>  'ekologiya',
	'12' =>  'obrazovanie',
	'13' =>  'apk',
	'14' =>  'chp',
	'15' =>  'narod-i-vlast',
	'16' =>  'zdravoohranenie',
	'17' =>  'pamyat',
	'18' =>  'lyudi-dela',
	'19' =>  'sport',
	'20' =>  'zakon-i-poryadok',
	'21' =>  'dobroe-imya',
	'22' =>  'kraj-rodnoj',
	'23' =>  'hronika-blagoustrojstva',
	'24' =>  'sotsialnaya-sfera',
	'25' =>  'zhkh',
	'26' =>  'novosti-regiona',
	'27' =>  'kriminal',
	'28' =>  'kultura',
	'29' =>  'territoriya-soglasiya',
	'30' =>  'gazeta-mayak',
	'31' =>  'sad-i-ogorod',
	'32' =>  'selskoe-hozyajstvo',
	'33' =>  'novosti-rajona',
	'34' =>  'territoriya-razvitiya',
	'35' =>  'dorogi',
	'36' =>  'novosti-poselenij',
	'37' =>  'talanty',
	'38' =>  'prazdnik',
	'39' =>  'budte-gotovy',
	'40' =>  'perspektivy-razvitiya',
	'41' =>  'prizvanie',
	'42' =>  'nasha-pobeda',
	'43' =>  'aktualno',
	'44' =>  'aktivnaya-pozitsiya',
	'45' =>  'domashnij-ochag',
	'46' =>  'traditsii',
	'47' =>  'gordost-rajona',
	'48' =>  'prokuratura-rajona',
	'49' =>  'pomnim',
	'50' =>  'problema',
	'51' =>  'territoriya-geroev',
	'52' =>  'territoriya-molodyh',
	'53' =>  'otdyh',
	'54' =>  'bezopasnost',
	'55' =>  'blagotvoritelnost',
	'56' =>  'volonterskoe-dvizhenie',
	'57' =>  'podvig',
	'58' =>  'vologodskoe-podvore_2021',
	'59' =>  'politika',
];

$tags = [
	'60' => 'dorogi',
	'61' => 'chrezvychajnye-situatsii',
	'62' => 'sport',
	'63' => 'obrazovanie',
	'64' => 'ekologiya',
	'65' => 'selskoe-hozyajstvo-2',
	'66' => 'obshhestvo',
	'67' => 'apk',
	'68' => 'brifing',
	'69' => 'vologodskij-rajon',
	'70' => 'zemlya',
	'71' => 'prazdnik',
	'72' => 'sotrudnichestvo',
	'73' => 'den-meditsinskogo-rabotnika',
	'74' => 'dobroe-imya',
	'75' => 'meditsina',
	'76' => 'bezopasnost-politsiya',
	'77' => 'blagoustrojstvo',
	'78' => 'gazifikatsiya',
	'79' => 'majskij',
	'80' => 'yubilej',
	'81' => 'kurkino',
	'82' => 'den-poselka',
	'83' => 'utkino',
	'84' => 'vertikal',
	'85' => 'tvorchestvo',
	'86' => 'brestskaya-krepost',
	'87' => 'vojna',
	'88' => 'bezopasnost',
	'89' => 'profilaktika',
	'90' => 'blagotvoritelnost',
	'91' => 'dobro',
	'92' => 'pomoshh',
	'93' => 'golos-remesel',
	'94' => 'istoriya',
	'95' => 'pamyat',
	'96' => 'shkolnoe-lesnichestvo',
	'97' => 'shkola',
	'98' => 'dosug',
	'99' => 'detskij-sport',
	'100' => 'karate',
	'101' => 'dialog-pokolenij',
	'102' => 'deti-vojny',
	'103' => 'muzej',
	'104' => 'zagotovka-kormov',
	'105' => 'drevesina',
	'106' => 'egais',
	'107' => 'les',
	'108' => 'vypuskniki',
	'109' => 'narodnyj-byudzhet',
	'110' => 'zagovene',
	'111' => 'novlenskoe',
	'112' => 'vysokovo',
	'113' => 'kraevedenie',
	'114' => 'plyazhnyj-volejbol',
	'115' => 'ufsin',
	'116' => 'den-semi',
	'117' => 'protivodejstvie-korruptsii',
	'118' => 'pchelovodstvo',
	'119' => 'semejnyj-kodeks',
	'120' => 'egrn',
	'121' => 'materinskij-kapital',
	'122' => 'vybory',
	'123' => 'doroga',
	'124' => 'politsiya',
	'125' => 'omon',
	'126' => 'rosgvardiya',
	'127' => 'vologodskaya-oblast',
	'128' => 'press-zavtrak',
	'129' => 'proforientatsiya',
	'130' => 'vologodskie-zori',
	'131' => 'den-vologodskogo-rajona',
	'132' => 'fetinino',
	'133' => 'vasilevskoe',
	'134' => 'koleso-epohi',
	'135' => 'molodezhnoe-podvore',
	'136' => 'mavr',
	'137' => 'molodezh',
	'138' => 'sledstvie',
	'139' => 'doshkolnoe-obrazovanie',
	'140' => 'ogarkovo',
	'141' => 'detskij-sad',
	'142' => 'proizvodstvo',
	'143' => 'antares',
	'144' => 'konnyj-sport',
	'145' => 'kubenskij-torzhok',
	'146' => 'yarmarka',
	'147' => 'spartakiada',
	'148' => 'administrativnoe-zakonodatelstvo',
	'149' => 'selskoe_hozyajstvo',
	'150' => 'bereznik',
	'151' => 'zaryadka-so-strazhem-poryadka',
	'152' => 'rdsh',
	'153' => 'futbol',
	'154' => 'detskij-kosmicheskij-festival',
	'155' => 'vysokovskaya-shkola',
	'156' => 'striznevo',
	'157' => 'remont',
	'158' => 'teplichnyj',
	'159' => 'den-znanij',
	'160' => 'molodezhnyj-parlament',
	'161' => 'poeziya',
	'162' => 'prazdnik-belyh-zhuravlej',
	'163' => 'den-rajona',
	'164' => 'olimp',
	'165' => 'hokkej',
	'166' => 'nadzor',
	'167' => 'prokuratura',
	'168' => 'edinyj-den-golosovaniya',
	'169' => 'biblioteka',
	'170' => 'fedotovo',
	'171' => 'gavrilin',
	'172' => 'veterany',
	'173' => 'garnizonnyj-instruktazh',
	'174' => 'borba-s-korruptsiej',
	'175' => 'zdravoohranenie',
	'176' => 'vsemirnyj-festival-molodezhi-i-studentov',
	'177' => 'sochi',
	'178' => 'podderzhka-molodyh-semej',
	'179' => 'vologodskoe-podvore',
	'180' => 'pobediteli',
	'181' => 'oblastnoj-selskij-shod',
	'182' => 'obshhestvennyj-sovet',
	'183' => 'dni-zashhity-ot-ekologicheskoj-opasnosti',
	'184' => 'god-ekologii',
	'185' => 'rgo',
	'186' => 'dni-nablyudenij-ptits',
	'187' => 'soyuz-ohrany-ptits-rossii',
	'188' => 'lesnoe-hozyajstvo',
	'189' => 'zelenyj-poyas',
	'190' => 'zarnitsa',
	'191' => 'zelenaya-rossiya',
	'192' => 'zolotaya-osen',
	'193' => 'narodnyj-uchastkovyj',
	'194' => 'moshennichestvo',
	'195' => 'sud',
	'196' => 'profilaktika-grippa',
	'197' => '90-let',
	'198' => 'den-pozhilogo-cheloveka',
	'199' => 'lesovosstanovlenie',
	'200' => 'spasskoe-kurkino',
	'201' => 'pedagogi',
	'202' => 'turizm',
	'203' => 'profsoyuz',
	'204' => 'sudebnye-pristavy',
	'205' => 'obshhestvennaya-palata',
	'206' => 'demografiya',
	'207' => 'zhivotnovodstvo',
	'208' => 'den-uchitelya',
	'209' => 'samaya-krasivaya-derevnya',
	'210' => 'gto',
	'211' => 'rosreestr',
	'212' => 'marina-moroshkova',
	'213' => 'aleksandr-klubov',
	'214' => 'vystavka',
	'215' => 'detki-kremlevskoj-elki',
	'216' => 'veteranskaya-organizatsiya',
	'217' => 'konkurs',
	'218' => 'oleg-zazhigin',
	'219' => 'mezhdunarodnyj-den-borby-s-rakom-molochnoj-zhelezy',
	'220' => 'nadzor-profilaktika-pozharov',
	'221' => 'shkola-liderov',
	'222' => 'gosuslugi',
	'223' => 'forum-soobshhestvo',
	'224' => 'mfts',
	'225' => 'sluzhba-v-armii',
	'226' => 'mashinostroenie',
	'227' => 'promyshlennost',
	'228' => 'dobrovolnaya-sdacha-oruzhiya-i-boepripasov',
	'229' => 'oplata-elektroenergii',
	'230' => 'den-avtomobilista',
	'231' => 'den-zdorovya',
	'232' => 'dinozavry',
	'233' => 'vojna-klubov',
	'234' => 'gibdd',
	'235' => 'den-narodnogo-edinstva',
	'236' => 'mchs',
	'237' => 'sozvezdie-muzhestva',
	'238' => 'molochnaya-promyshlennost',
	'239' => 'yubilej-veterana',
	'240' => 'narodnyj-doktor',
	'241' => '1917',
	'242' => 'dobrovolnaya-sdacha-oruzhiya',
	'243' => 'profilaktika-pozharov',
	'244' => 'dolevoe-stroitelstvo',
	'245' => 'yunarmiya',
	'246' => 'veteranskoe-podvore',
	'247' => 'sluzhba-sudebnyh-pristavov',
	'248' => 'den-materi',
	'249' => 'smotr-poslednih-del',
	'250' => 'komanda-gubernatora',
	'251' => 'sergej-zhestyannikov',
	'252' => 'edinaya-rossiya',
	'253' => 'ochered',
	'254' => 'partiya',
	'255' => 'vologda',
	'256' => 'rajon',
	'257' => 'vologodskij',
	'258' => 'deti',
	'259' => 'kadet',
	'260' => 'klass',
	'261' => 'lesnoj',
	'262' => 'mayak',
	'263' => 'smi',
	'264' => 'aktivnoe-dolgoletie',
	'265' => 'territoriya-sporta',
	'266' => 'musor',
	'267' => 'othody',
	'268' => 'svalka',
	'269' => 'detskaya-ploshhadka',
	'270' => 'druzhnye-sosedi',
	'271' => 'ostahovo',
	'272' => 'mozhajskoe',
	'273' => 'nepotyagovo',
	'274' => 'fevronii',
	'275' => '1942',
	'276' => '1945',
	'277' => 'boets',
	'278' => 'krasnaya-armiya',
	'279' => 'pobeda',
	'280' => 'poiskovik',
	'281' => 'rossiya',
	'282' => 'zhkh',
	'283' => 'zhurnalisty',
	'284' => 'kotelnaya',
	'285' => 'mhl',
	'286' => 'nmhl',
	'287' => 'severstal',
	'288' => 'venchanie',
	'289' => 'esenin',
	'290' => 'zhestyannikov',
	'291' => 'kiriki',
	'292' => 'rajh',
	'293' => 'ulity',
	'294' => 'perevo',
	'295' => 'ulitsa',
	'296' => 'astafurova',
	'297' => 'vospominaniya',
	'298' => 'lyudi',
	'299' => 'moskva',
	'300' => 'vdv',
	'301' => 'ded-moroz',
	'302' => 'parashyut',
	'303' => 'uborochnaya',
	'304' => 'nardnyj-kontrol',
	'305' => 'kubenskoe',
	'306' => 'politika',
	'307' => 'ekonomika',
	'308' => 'den-fizkulturnika',
	'309' => 'nalog',
	'310' => 'fermer',
	'311' => 'mololdezh',
	'312' => 'slet',
	'313' => 'zhatva',
	'314' => 'urozhaj',
	'315' => 'borisovo',
	'316' => 'pensioner',
	'317' => 'sotsialnaya-rabota',
	'318' => 'zarya',
	'319' => 'vov',
	'320' => 'memorial',
	'321' => 'aleksino',
	'322' => 'dolshhiki',
	'323' => 'investor',
	'324' => 'vologodskie-luga',
	'325' => 'kort',
	'326' => 'trenazhery',
	'327' => 'grant',
	'328' => 'territoriya-sprta',
	'329' => 'mobilnaya-priemnaya',
	'330' => 'zernovye',
	'331' => 'uborka',
	'332' => 'otkryto',
	'333' => 'derevnya',
	'334' => 'byudzhet',
	'335' => 'den-flaga',
	'336' => 'flag',
	'337' => 'gubernator',
	'338' => 'profilnye-klassy',
	'339' => 'shkoly',
	'340' => 'nedelya-v-armii',
	'341' => 'doshkolniki',
	'342' => 'prezidentskij',
	'343' => 'usadba',
	'344' => 'produkty',
	'345' => 'forum',
	'346' => 'shag-vpered',
	'347' => 'zdorove',
	'348' => 'znaj-nashih',
	'349' => 'feldsher',
	'350' => 'proekt',
	'351' => 'pozharnye-vodoem',
	'352' => 'znaj-nashh',
	'353' => 'volejbol',
	'354' => 'vlksm',
	'355' => 'komsomol',
	'356' => 'kolokola',
	'357' => 'hram',
	'358' => 'festival',
	'359' => 'voda',
	'360' => 'ochistnye',
	'361' => 'magazin',
	'362' => 'dk',
	'363' => 'kultura',
	'364' => 'osveshhenie',
	'365' => 'gorodskaya-sreda',
	'366' => 'ovoshhi',
	'367' => 'selsko-hozyajstvo',
	'368' => 'urozhajnost',
	'369' => 'zhensovet',
	'370' => 'kadety',
	'371' => 'uchastkovye',
	'372' => 'internet',
	'373' => 'moshenniki',
	'374' => 'rovd',
	'375' => 'italiya',
];
//тут все файлы сайта будут
$xmlfiles = processXML(__DIR__ . '/media.xml');
foreach ($xmlfiles->channel->item as $file) {
	$allFiles[parseContent($file->children('wp', true)->post_id)] = parseContent(trim($file->children('wp', true)->attachment_url));
}

//	идём по постам
foreach ($xml->channel->item as $post) {
	$data = [];
	$type = $post->children('wp', true)->post_type;
	$wp = $post->children('wp', true);
	$data['source_link'] =	parseContent($post->link);
	$data['wp_id'] =		parseContent($post->children('wp', true)->post_id);
	$data['pagetitle'] =	parseContent((string)$post->title);
	$data['introtext'] =	parseContent(trim((string)$post->children('excerpt', true)->encoded));
	$data['alias'] =		parseContent(trim((string)$post->children('wp', true)->post_name));
	$data['publish'] =		$post->children('wp', true)->status == "publish" ? 1 : 0;
	$data['createdon'] =	strtotime((string)$post->pubDate);
	if (empty($data['createdon'])) {
		$data['createdon'] = strtotime((string)$wp->post_date);
	}
	$parser = new WP_Block_Parser();
	$parse_content = $parser->parse($post->children('content', true));

	$data['content'] = null;
	// форматы
	foreach ($parse_content as $key => $block) {
		if (!empty($block['blockName'])) {
			switch ($block['blockName']) {
				case 'core/paragraph':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/image':
					if (@count($block['attrs']) && isset($block['attrs']['id'])) {
						$img_id = $block['attrs']['id'];	// id to media.xml
						if (!empty($img_id)) {
							$data['content'] .= '<img src="' . str_replace('/wp-content', 'assets/images', parse_url($allFiles[$img_id])['path']) . '">';
						}
					}

					break;
				case 'core/gallery':
					if (@count($block['attrs']['ids'])) {
						$data['content'] .= '<div class="gallery">';
						foreach ($block['attrs']['ids'] as $key => $id) {
							$href = str_replace('/wp-content', 'assets/images', parse_url($allFiles[$id])['path']);
							$data['content'] .= '<a rel="gallery" href="'.$href .'"><img src="' . $href . '"></a>';
						}
						$data['content'] .= '</div>';
					}
					break;
				case 'core/quote':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/list':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/table':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/heading':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/html':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/video':
					$data['content'] .= $block['innerHTML'];
					break;
				case 'core/group':
					//wp:group remove!
					break;
				case 'core/file':
					$data['content'] .=  '<a href="'.str_replace('/wp-content', 'assets/images', parse_url($allFiles[$block['attrs']['id']])['path']) . '" download>Скачать</a>';
					break;
				case 'core-embed/youtube':

					break;
				default:
					$data['content'] .= $block['innerHTML'];
					//var_dump($data['wp_id']);
					//die;
					break;
			}
		} else {
			$data['content'] .=	preg_replace("/\r\n|\r|\n/", "", trim($block['innerHTML']));
		}
	}
	// Теги и рубрики
	foreach ($post->category as $category) {
		if ($category["domain"] == "category") {
			$data['category_alias'] = trim(parseContent($category["nicename"]));
			$data['category_name'] = trim(parseContent($category));
			if (!in_array($data['category_alias'], $allCats)) {
				$allCats[$data['category_alias']] = $data['category_name'];
			}
			//	вот эта строка совмещает категорию в вп и "папку" в Эво на основе массива  ресурсов cats выше
			$data['category'] = array_search($data['category_alias'], $cats);
		} else if ($category["domain"] == "post_tag") {
			$tagname = trim(parseContent($category["nicename"]));
			$tagvalue = trim(parseContent($category));
			$data['tags_names'][$tagname] = $tagvalue;
			if (!in_array($tagname, $allTags)) {
				$allTags[$tagname] = $tagvalue;
			}
			//	вот эта строка совмещает тег в вп и "папку" в Эво на основе массива tags выше
			$data['tags'][] = array_search($tagname, $tags);
		}
	}
	// тащим айдишки файлов из массива, строим путь 
	$data['tags'] = implode(",",$data['tags']);
	foreach ($post->children('wp', true)->postmeta as $wpm) {
		if (trim(parseContent($wpm->meta_key)) == "_thumbnail_id" && !empty(trim(parseContent($wpm->meta_value)))) {
			$data['wp_thumb_id'] = parseContent((string) trim($wpm->meta_value));
			$data['thumb'] = str_replace('/wp-content', 'assets/images', parse_url($allFiles[$data['wp_thumb_id']])['path']);
		}
	}
	$allPosts[] = $data;
	//var_dump($data);die;
}
//var_dump($allPosts);
//var_dump($allCats);
//var_dump($allTags);

/*
$apiClassName = 'Pathologic\EvolutionCMS\MODxAPI\modResource';
if (!class_exists($apiClassName)) {
	include_once(MODX_BASE_PATH . "assets/lib/MODxAPI/modResource.php");
	$apiClassName = 'modResource';
}
$res = $modx->db->select('contentid,value', 'evo_site_tmplvar_contentvalues', 'tmplvarid = 19');
while ($row = $modx->db->getRow($res)) {
	$docs[$row['value']] = $row['contentid'];
}

foreach ($allPosts as $key => $post) {
	$doc = new $apiClassName($modx);
	if (array_key_exists($post['wp_id'], $docs)) {
		
		$doc->edit($docs[$post['wp_id']]);
		$doc->set('source_link', $post['source_link']);
		$doc->set('wp_id', $post['wp_id']);
		$doc->set('pagetitle', $post['pagetitle']);
		$doc->set('introtext', $post['introtext']);
		$doc->set('metadescription', $post['introtext']);
		$doc->set('alias', $post['alias']);
		$doc->set('publish', $post['publish']);
		$doc->set('createdon', $post['createdon']);
		$doc->set('content', $post['content']);
		$doc->set('category', $post['category']);
		$doc->set('mainphoto', $post['thumb']);
		$doc->set('ogimage', $post['thumb']);
		$doc->set('tags', $post['tags']);
		$doc->set('template', 10);
		$doc->set('parent', 377);
		
		echo "Update \n";
	} else {
		$doc->create(array(
			'source_link' => $post['source_link'],
			'wp_id' => $post['wp_id'],
			'pagetitle' => $post['pagetitle'],
			'introtext' => $post['introtext'],
			'metadescription' => $post['introtext'],
			'alias' => $post['alias'],
			'publish' => $post['publish'],
			'createdon' => $post['createdon'],
			'content' => $post['content'],
			'category' => $post['category'],
			'mainphoto' => $post['thumb'],
			'ogimage' => $post['thumb'],
			'tags' => $post['tags'],
			'template' => 10,
			'parent' => 377
		));
		echo "Create \n";
	}
	$id = $doc->save(true, false);
	echo "id: $id \n";
	//die;
}

*/