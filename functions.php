<?php
function test_input($data)
{
$cyr = array('а','б','в','г','д','e','ж','з','и','й','к','л','м','н','о','п','р','с','т','у', 
			 'ф','х','ц','ч','ш','щ','ъ','ь','ю','я','А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
			 'Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ь', 'Ю','Я', 'ј', 'е','Љ','љ','Њ','њ','Ћ','ћ','Ђ','ђ','Џ','џ');
			 
$lat = array('a','b','v','g','d','e','z','z','i','y','k','l','m','n','o','p','r','s','t','u',
			 'f','h','c','s','s','s','a','y','yu','ya','A','B','V','G','D','E','Z','Z','I','Y','K','L','M','N','O','P','R','S','T','U',
			 'F' ,'H' ,'C' ,'C','S' ,'S' ,'A' ,'Y' ,'Yu' ,'Ya', 'j', 'e','Lj','lj','Nj','nj','C','c','Dj','dj','Dz','dz');

$search =  array('ç','æ','œ','á','é','í','ó','ú','à','è','ì','ò','ù','ä','ë','ï','ö','ü','ÿ','â','ê','î','ô','û','å','ø',
				 'Þ','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','þ','ÿ',
				 'Ç','Æ','Œ','Á','É','Í','Ó','Ú','À','È','Ì','Ò','Ù','Ä','Ë','Ï','Ö','Ü','Ÿ','Â','Ê','Î','Ô','Û','Å','Ø',
				 'Þ','ß','À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','Þ','Ÿ',
				 'š','đ','ž','ć','č','Š','Đ','Ž','Ć','Č', 'İ');

$replace = array('c','a','o','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','y','a','e','i','o','u','a','o',
				 'p','b','a','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','d','n','o','o','o','o','o','o','u','u','u','u','y','p','y',
				 'C','A','O','A','E','I','O','U','A','E','I','O','U','A','E','I','O','U','Y','A','E','I','O','U','A','O',
				 'P','B','A','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','P','Y',
				 's','d','z','c','c','S','D','Z','C','C', 'I');


$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
$data = str_replace($cyr, $lat, $data);
$data = str_replace($search, $replace, $data);
$data = preg_replace("/[áàâãªä]/u","a",$data);
$data = preg_replace("/[ÁÀÂÃÄ]/u","A",$data);
$data = preg_replace("/[ÍÌÎÏ]/u","I",$data);
$data = preg_replace("/[íìîï]/u","i",$data);
$data = preg_replace("/[éèêë]/u","e",$data);
$data = preg_replace("/[ÉÈÊË]/u","E",$data);
$data = preg_replace("/[óòôõºö]/u","o",$data);
$data = preg_replace("/[ÓÒÔÕÖ]/u","O",$data);
$data = preg_replace("/[úùûü]/u","u",$data);
$data = preg_replace("/[ÚÙÛÜ]/u","U",$data);
$data = preg_replace("/[’‘‹›‚]/u","'",$data);
$data = preg_replace("/[“”«»„]/u",'"',$data);
$data = str_replace("–","-",$data);
$data = str_replace(" "," ",$data);
$data = str_replace("ç","c",$data);
$data = str_replace("Ç","C",$data);
$data = str_replace("ñ","n",$data);
$data = str_replace("Ñ","N",$data);
return $data;
}


function clean_risks($data)
{
$search = array("inadequate_hou", "lack_of_accese", "health_risks", "lack_of_job_an", "material_hards", "psychological_", "social_exclusi", "lack_of_inform", ", issing_docume", "lack_of_access_1", "access_to_asyl", "lack_of_physic", ", hysical_abuse", "emotional_abus", "sexual_abuse_a", "explotation", "neglect_and_ne", "violence", "lack_of_indivi", "lack_of_partic", "lack_of_possib", "discrimination", "concern_relati", "lack_of_inform_1", "lack_of_assist", "no_protection_", "other");
$replace = array("Inadequate Housing", "Access to Education", "Health Risks", "Lack of Job", "Material Hardship", "Psychological Concerns", "Social Exclusion", "Lack of Information", "Missing Documents", "Access to a Fair Judical Procedure", "Access to Asylum", "Physical Security", "Physical Abuse", "Emotional Abuse", "Sexual Abuse and Explotation", "Explotation", "Neglect of Child", "Violence", "Individualized Approach for UASC", "Lack of Participation", "Development Possibilities", "Discrimination", "Reproductive Health and Safe Motherhood", "Info. on Missing Persons", "Assistance to Disabled", "No Risks", "Other");
$data = str_replace($search, $replace, $data);
return $data;
}?>
