<?php 
include("function.php");
?>




<?php 

if ($text == "/start"){
    
    reply_bot("Hallo selamat datang di bot anime ini
    
Menu:
/start
/tutorial
/waifu
/anime
/help
/quotes");
}

elseif($text == "/tutorial"){
    reply_bot("halo selamat datang di tutorial bot anime, kamu dapat klik /start untuk memulai");
}
elseif($text == "/waifu"){
    send_image_bot(random_item(array("https://cdn.kincir.com/1/production/media/2019/juli/7-karakter-cewek-terbaik-anime-spring-2019/kana-kojima-why-the-hell-are-you-here-teacher.jpg","https://thumb.suara.com/N3Pq2WaPousik3vRnaCD5yaXrPo=/653x366/https://media.suara.com/pictures/653x366/2022/06/12/27185-ilustrasi-karakter-anime-marin-kitagawa-imdb.jpg","https://cdn.popmama.com/content-images/post/20220301/nezukojpg-dca6b3ec374597e9424efb5b37956a81_600xauto.jpg")),"ini adalah waifu kamu!");
}
elseif($text == "/anime"){
    reply_bot("Anime terbaru adalah\n One piece\n Isekai maou\nisekai quartet");
}
elseif($text == "/help"){
    reply_bot("Jika ada yang di tanyakan silahkan tanya ke admin @zerif_sanjaya");
}
elseif($text == "/quotes"){
    
    reply_bot(random_item(array("Hanya seseorang yang takut yang bisa bertindak berani. Tanpa rasa takut itu tidak ada apa pun yang bisa disebut berani","Jadilah diri kamu sendiri. Siapa lagi yang bisa melakukannya lebih baik ketimbang diri kamu sendiri?","Pikiran kamu bagaikan api yang perlu dinyalakan, bukan bejana yang menanti untuk diisi.","Pikiran kamu bagaikan api yang perlu dinyalakan, bukan bejana yang menanti untuk diisi")));
    
}
else{
    reply_bot("Command tidak di temukan!");
}


?>
