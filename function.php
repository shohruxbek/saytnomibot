<?php


function sayt($chat_id,$sayt,$zona){
	$sayt = strtolower($sayt);
	$sayt = str_replace('https://', '', $sayt);
	$sayt = str_replace('http://', '', $sayt);
	$zona = strtolower($zona);


	$sayt = filter_var( trim($sayt), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$zona = filter_var( trim($zona), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	if($zona=='uz' or $zona=='com' or $zona=='net' or $zona=='org' or $zona=='biz' or $zona=='info' or $zona=='ru'){

		$res = file_get_contents("https://cctld.uz/whois/?domain=$sayt&zone=$zone");
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>$res
		]);
		if(mb_stripos($res, "домени мавжуд эмас")){
			bot('sendMessage',[
				'chat_id'=>$chat_id,
				'text'=>"Ushbu domen: {$sayt}.{$zona} hali sotib olinmagan",
			]);

			bot('sendMessage',[
				'chat_id'=>"-1001864979589",
				'text'=>"🔍{$sayt}.{$zona} ❌ \n[Yuboruvchi](tg://user?id=$chat_id) - $chat_id",
				'parse_mode'=>"markdown"
			]);
		}else{
			$res1 = explode('table-striped', $res);
			$res2 = explode('</table>', $res1[1]);
			$res3 = $res2[0];
			$res3 = str_replace("</tr>", "", $res3);
			$res3 = str_replace("strong>", "strong>%", $res3);
			$res3 = str_replace("<tr", "", $res3);
			$res3 = str_replace(" [at] ", "@", $res3);
			$res3 = str_replace("</td>", "*", $res3);
			$res3 = str_replace("<td", "", $res3);
			$res3 = str_replace("&nbsp;", " ", $res3);
			$res3 = strip_tags($res3);
			$res3 = str_replace(">", "", $res3);
			$res3 = trim(preg_replace('/\s\s+/', ' ', $res3));
			$res3 = str_replace('colspan="1"', "", $res3);
			$res3 = str_replace('colspan="2"', "", $res3);
			$res3 = str_replace('colspan="3"', "", $res3);
			$res3 = str_replace('colspan="4"', "", $res3);
			$res3 = str_replace('colspan="5"', "", $res3);
			$res3 = str_replace('colspan="6"', "", $res3);
			$res3 = str_replace('colspan="7"', "", $res3);
			$res3 = str_replace('colspan="8"', "", $res3);
			$res3 = str_replace('colspan="9"', "", $res3);
			$res3 = str_replace('colspan="10"', "", $res3);
			$res3 = str_replace('style="text-align: center;"', "", $res3);
			$res3 = str_replace('*', "\n", $res3);
			$res3 = str_replace("style='visibility:hidden'", "", $res3);
			$res3 = str_replace('table-condensed"', "", $res3);
			$res3 = str_replace('id="customeremail"', "", $res3);
			$res3 = str_replace('id="contactname"', "", $res3);
			$res3 = str_replace('&quot;', '"', $res3);
			$res3 = str_replace('id="customerphone"', '', $res3);
			$res3 = str_replace('"  ', '', $res3);


			$d = explode("%", $res3);
			$r = count($d);
			if($r%2==0){
				$res3.="%";
			}
			$res3 = str_replace("%", '*', $res3);
			$res3 = str_replace(": *\n", ': *', $res3);
			$res3 .= "\n\n*🔍 Sayt qidirivchi:* @saytnomibot";

			$res3 = str_replace("МИЖОЗ ҲАҚИДА МАЪЛУМОТ", "\n🔹МИЖОЗ ҲАҚИДА МАЪЛУМОТ:\n", $res3);
			$res3 = str_replace("ДОМЕН ҲАҚИДА МАЪЛУМОТ", "\n🔹ДОМЕН ҲАҚИДА МАЪЛУМОТ:", $res3);
			$res3 = str_replace("МАЪМУРИЯТ БИЛАН БОҒЛАНИШ", "\n🔹МАЪМУРИЯТ БИЛАН БОҒЛАНИШ:\n", $res3);
			$res3 = str_replace("ТЕХНИК МАСАЛАЛАР БЎЙИЧА БОҒЛАНИШ", "\n🔹ТЕХНИК МАСАЛАЛАР БЎЙИЧА БОҒЛАНИШ:\n", $res3);
			$res3 = str_replace("БИЛЛИНГ АЛОҚА", "\n🔹БИЛЛИНГ АЛОҚА:\n", $res3);
			$res3 = str_replace("Таъриф:", "🔹Таъриф:", $res3);
			$res3 = str_replace("  ", "", $res3);
			$res3 = str_replace("\n ", "\n", $res3);
			$res3 = str_replace("\n ", "\n", $res3);
			$res3 = str_replace("\n ", "\n", $res3);
			$res3 = str_replace("Домен:", "\n-Домен:", $res3);
			$res3 = str_replace("IP:", "\n-IP:", $res3);
			$res3 = str_replace("Ҳолати:", "-Ҳолати:", $res3);

			$t1 = explode("🔹МИЖОЗ ҲАҚИДА МАЪЛУМОТ:", $res3)[0];

			$t2 = explode("Рўйхатдан ўтказувчи:", $t1)[1];
$t3 = explode("Иккинчи NS:", $t2)[0]; //Рўйхатдан ўтказувчи:

$t4 = explode("Рўйхатдан ўтган сана:", $t1)[1];
$t5 = explode("Учинчи NS:", $t4)[0]; //Рўйхатдан ўтган сана:

$t6 = explode("Фаолияти тугайди:", $t1)[1];
$t7 = explode("Тўртинчи NS:", $t6)[0]; //Фаолияти тугайди:


$t71 = explode("Биринчи NS:", $t1)[1];
$t72 = explode("Рўйхатдан ўтказувчи:", $t71)[0];//domen ip

$t8 = explode("Иккинчи NS:", $t1)[1];
$t9 = explode("Рўйхатдан ўтган сана:", $t8)[0];//domen ip

$t10 = explode("Учинчи NS:", $t1)[1];
$t11 = explode("Фаолияти тугайди:", $t10)[0];//domen ip

$t12 = explode("Тўртинчи NS:", $t1)[1];//domen ip

$all = explode("🔹Таъриф:", $t1)[0]."Рўйхатдан ўтказувчи: ".$t3."Рўйхатдан ўтган сана:".$t5."Фаолияти тугайди:".$t7."\n🔸Биринчи NS:".$t72."🔸Иккинчи NS:".$t9."🔸Учинчи NS:"."$t11"."🔸Тўртинчи NS:".$t12."🔹МИЖОЗ ҲАҚИДА МАЪЛУМОТ:".explode("🔹МИЖОЗ ҲАҚИДА МАЪЛУМОТ:", $res3)[1];

$all = str_replace("Рўйхатдан ўтказувчи:", "-Рўйхатдан ўтказувчи:", $all);
$all = str_replace("Рўйхатдан ўтган сана:", "-Рўйхатдан ўтган сана:", $all);
$all = str_replace("Фаолияти тугайди:", "-Фаолияти тугайди:", $all);

$all = str_replace("\n\n", "\n", $all);
$all = str_replace("\n \n", "\n", $all);
$all = str_replace("\n ", "\n", $all);
$all = str_replace("\n ", "\n", $all);


bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔍 Natija:\n$all",
	'parse_mode'=>"markdown"
]);

bot('sendMessage',[
	'chat_id'=>"-1001864979589",
	'text'=>"🔍{$sayt}.{$zona} ✅ \n[Yuboruvchi](tg://user?id=$chat_id) - $chat_id",
	'parse_mode'=>"markdown"
]);
}





}else{
	bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"Siz kiritgan zona mos kelmadi. \nMavjud zonalar => [uz][com][net][org][biz][info][ru]",
	]);
}
}
	?>