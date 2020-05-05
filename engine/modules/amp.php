<?php
/**
 * Файл: amp.php
 * Изначальная идея и реализация:
 * - DomiTori https://domitori.ru/
 *
 * Доработки:
 * - mail@tcse-cms.com
 * - pafnuty10@gmail.com
 *
 * Ссылка на репозиторий:
 * - https://github.com/tcse/AMP4DLE
 */

$tpl->load_template('amp.tpl');

/**
 * @param $m  - Matches
 *
 * @return string empty sting or amp-img tag
 */
function replaceImages($m) {
    global $config;

    $url = $m[1];
    $alt = $m[2];

    $returnResult = '';

    // Если это смайлик или спойлер — пропускаем.
    if (stripos($url, 'dleimages') !== false
        || stripos($url, 'engine/data/emoticons') !== false
    ) {
        return $returnResult;
    }

    if (stripos($url, $config['http_home_url']) !== false) {
        $urlPart = explode($config['http_home_url'], $url)[1];
        $imgInfo = @getimagesize(ROOT_DIR.'/'.$urlPart);

        $src    = $url;
        $width  = $imgInfo[0];
        $height = $imgInfo[1];

        $returnResult = '<amp-img alt="'.$alt.'" src="'.$src.'" width="'.$width.'" height="'.$height
            .'" layout="responsive"></amp-img>';
    }

    return $returnResult;
}

// Формирование ссылки на полную новость

if ($config['allow_alt_url']) {
    if ($config['seo_type'] == 1 OR $config['seo_type'] == 2) {
        if ($category_id AND $config['seo_type'] == 2) {
            $c_url     = get_url($category_id);
            $full_link = $config['http_home_url'].$c_url."/".$row['id']."-".$row['alt_name'].".html";
        } else {
            $full_link = $config['http_home_url'].$row['id']."-".$row['alt_name'].".html";
        }
    } else {
        $full_link = $config['http_home_url'].date('Y/m/d/', $row['date']).$row['alt_name'].".html";
    }
} else {
    $full_link = $config['http_home_url']."index.php?newsid=".$row['id'];
}
$tpl->set('{full-link}', $full_link);

// Формирование списка категорий

if ($config['category_separator'] != ',') {
    $config['category_separator'] = ' '.$config['category_separator'];
}

if (!$row['category']) {
    $my_cat      = "---";
    $my_cat_link = "---";
} else {

    $my_cat      = [];
    $my_cat_link = [];
    $cat_list    = explode(',', $row['category']);

    if (count($cat_list) == 1) {

        if ($allow_list[0] != "all" AND !in_array($cat_list[0], $allow_list)) {
            $perm = 0;
        }

        if ($not_allow_cats[0] != "" AND in_array($cat_list[0], $not_allow_cats)) {
            $perm = 0;
        }

        $my_cat[] = $cat_info[$cat_list[0]]['name'];

        $my_cat_link = get_categories($cat_list[0], $config['category_separator']);

    } else {

        foreach ($cat_list as $element) {

            if ($allow_list[0] != "all" AND !in_array($element, $allow_list)) {
                $perm = 0;
            }

            if ($not_allow_cats[0] != "" AND in_array($element, $not_allow_cats)) {
                $perm = 0;
            }

            if ($element) {
                $my_cat[] = $cat_info[$element]['name'];
                if ($config['allow_alt_url']) {
                    $my_cat_link[] = "<a href=\"".$config['http_home_url'].get_url($element)
                        ."/\">{$cat_info[$element]['name']}</a>";
                } else {
                    $my_cat_link[]
                        = "<a href=\"$PHP_SELF?do=cat&amp;category={$cat_info[$element]['alt_name']}\">{$cat_info[$element]['name']}</a>";
                }
            }
        }

        $my_cat_link = implode("{$config['category_separator']} ", $my_cat_link);
    }

    $my_cat = implode("{$config['category_separator']} ", $my_cat);
}

$tpl->set('[full-link]', "<a href=\"".$full_link."\">");
$tpl->set('[/full-link]', "</a>");

// Обработка доп полей

$xfields_amp = xfieldsdataload($row['xfields']);
if (count($xfields_amp)) {
    $xfieldsdata = $xfields_amp;
    foreach ($xfields as $value) {
        $preg_safe_name = preg_quote($value[0], "'");
        if ($value[6] AND !empty($xfieldsdata[$value[0]])) {
            $temp_array = explode(",", $xfieldsdata[$value[0]]);
            $value3     = [];
            foreach ($temp_array as $value2) {
                $value2 = trim($value2);
                $value2 = str_replace("&#039;", "'", $value2);
                if ($config['allow_alt_url']) {
                    $value3[] = "<a href=\"".$config['http_home_url']."xfsearch/".urlencode($value2)."/\">".$value2
                        ."</a>";
                } else {
                    $value3[] = "<a href=\"$PHP_SELF?do=xfsearch&amp;xf=".urlencode($value2)."\">".$value2."</a>";
                }
            }

            $xfieldsdata[$value[0]] = implode(", ", $value3);
            unset($temp_array);
            unset($value2);
            unset($value3);
        }

        if (empty($xfieldsdata[$value[0]])) {
            $tpl->copy_template
                                = preg_replace("'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is",
                "", $tpl->copy_template);
            $tpl->copy_template = str_replace("[xfnotgiven_{$value[0]}]", "", $tpl->copy_template);
            $tpl->copy_template = str_replace("[/xfnotgiven_{$value[0]}]", "", $tpl->copy_template);
        } else {
            $tpl->copy_template
                                = preg_replace("'\\[xfnotgiven_{$preg_safe_name}\\](.*?)\\[/xfnotgiven_{$preg_safe_name}\\]'is",
                "", $tpl->copy_template);
            $tpl->copy_template = str_replace("[xfgiven_{$value[0]}]", "", $tpl->copy_template);
            $tpl->copy_template = str_replace("[/xfgiven_{$value[0]}]", "", $tpl->copy_template);
        }

        $xfieldsdata[$value[0]] = stripslashes($xfieldsdata[$value[0]]);

        $tpl->copy_template = str_replace("[xfvalue_{$value[0]}]", $xfieldsdata[$value[0]], $tpl->copy_template);
    }
}

// Автор новости

if ($config['allow_alt_url']) {

    $go_page = $config['http_home_url']."user/".urlencode($row['autor'])."/";

} else {

    $go_page = "$PHP_SELF?subaction=userinfo&amp;user=".urlencode($row['autor']);

}

$tpl->set('[profile]', "<a href=\"".$go_page."\">");
$tpl->set('[/profile]', "</a>");

$tpl->set('{login}', $row['autor']);
$tpl->set('{views}', number_format($row['news_read'], 0, ',', ' '));

// Работаем с датой добавления новости

$seo_data  = str_replace(" ", "T", $row['date']);
$mas_data  = explode("T", $seo_data);
$mass_data = explode("-", $mas_data[0]);
$data      = $mass_data[2].".".$mass_data[1].".".$mass_data[0];
$tpl->set('{date}', $data);
$tpl->set('{seo-date}', $seo_data);

// Формирование различных тегов
$tpl->set('{title}', stripslashes($row['title']));

$newsContent = ($row['full_story']) ? stripcslashes($row['full_story']) : stripcslashes($row['short_story']);

$count               = 150;
$newsContentStripped = preg_replace("#<!--TBegin(.+?)<!--TEnd-->#is", "", $newsContent);
$newsContentStripped = preg_replace("#<!--MBegin(.+?)<!--MEnd-->#is", "", $newsContentStripped);
$newsContentStripped = preg_replace("#<!--dle_spoiler(.+?)<!--spoiler_text-->#is", "", $newsContentStripped);
$newsContentStripped = preg_replace("#<!--spoiler_text_end-->(.+?)<!--/dle_spoiler-->#is", "", $newsContentStripped);
$newsContentStripped = preg_replace("'\[attachment=(.*?)\]'si", "", $newsContentStripped);
$newsContentStripped = preg_replace("#\[hide(.*?)\](.+?)\[/hide\]#is", "", $newsContentStripped);
$newsContentStripped = str_replace("><", "> <", $newsContentStripped);
$newsContentStripped = strip_tags($newsContentStripped, "<br>");
$newsContentStripped = trim(str_replace("<br>", " ",
    str_replace("<br />", " ", str_replace("\n", " ", str_replace("\r", "", $newsContentStripped)))));
$newsContentStripped = preg_replace('/\s+/u', ' ', $newsContentStripped);

if ($count AND dle_strlen($newsContentStripped, $config['charset']) > $count) {
    $newsContentStripped = dle_substr($newsContentStripped, 0, $count, $config['charset']);
    if (($temp_dmax = dle_strrpos($newsContentStripped, ' ', $config['charset']))) {
        $newsContentStripped = dle_substr($newsContentStripped, 0, $temp_dmax, $config['charset']);
    }
}

$tpl->set('{description}', $newsContentStripped);

$newsContent = preg_replace_callback('/<img.*?src="(.*?)".*?alt="(.*?)".*?>/i', 'replaceImages', $newsContent);

$tpl->set('{full-story}', $newsContent);

$tpl->set('{link-category}', $my_cat_link);
$tpl->set('{site-name}', $config['home_title']);
$tpl->set('{site-url}', $config['http_home_url']);
$tpl->set('{THEME}', $config['http_home_url']."templates/".$config['skin']);

// Последние приготовления

$tpl->compile('main');
$tpl->clear();
echo $tpl->result['main'];
die();