/*document.getElementById('form').onsubmit = function(event){
    event.preventDefault(); //　event.preventDefaultメソッドは、submitイベントの発生元であるフォームが持つデフォルトの動作（この場合はフォームの内容を指定したURLへ送信するという動作）をキャンセルするメソッド。
    const search = document.getElementById('form').word.value;
    document.getElementById('output').textContent = `${search}の検索中。。`;
} */

/*const now = new Date();//Dateインスタンスを生成。
const year = now.getFullYear();//nowインスタンスのgetFull..メソッドを使用。以下同様.
const month = now.getMonth();
const date = now.getDate();
const hour = now.getHours();
const minute = now.getMinutes();
console.log(now);

let ampm = ''//変数の初期化。
if(hour >12){
ampm = 'a.m.'; //1から12まで
}else{
ampm = 'p.m.'; //12以上    
}

const output = `${year}/${month + 1}/${date} ${hour % 12}:${minute}${ampm}`;
document.getElementById('time').textContent = output;*/

//画像切り替え（クリックによる）
/*const images = ['piano_kuma.png','game_igo_ban.png','mark_onsen.png']; //画像を配列に格納。
console.log(images.length);

let currentNumber = 0; //取得する配列の中の画像の番号を格納する変数。

function changeImage(num){
    if(currentNumber + num <= images.length){
        currentNumber += num;
        document.getElementById('main_image').src = images[currentNumber];
    }
    if(currentNumber + num > images.length){
        currentNumber = 0;
        document.getElementById('main_image').src = images[currentNumber];
    }
}
document.getElementById('change').onclick = function(){
    changeImage(1);
}*/

 //ナビ部分の単語入れ替え
const wordsOfApple = ['Apple','사과','苹果'];
const wordsOfOrange = ['Orange','귤','橙'];
const wordsOfBanana = ['Banana','바나나','香蕉'];

const hoverLang1 = document.getElementById('hover_lang1');
hoverLang1.onmouseover = function(){  /*mouseover*/ 
    let num1 = Math.floor(Math.random() * 3);
    hoverLang1.textContent = wordsOfApple[num1];
}

hoverLang1.onmouseleave = function(){
hoverLang1.textContent = 'リンゴ';
  }

const hoverLang2 = document.getElementById('hover_lang2');
hoverLang2.onmouseover = function(){
    let num2 = Math.floor(Math.random() * 3);
    hoverLang2.textContent = wordsOfOrange[num2];
}

hoverLang2.onmouseleave = function(){
    hoverLang2.textContent = 'みかん';
}

const hoverLang3 = document.getElementById('hover_lang3');
hoverLang3.onmouseover = function(){
    let num3 = Math.floor(Math.random() * 3);
    hoverLang3.textContent = wordsOfBanana[num3];
}

hoverLang3.onmouseleave = function(){
    hoverLang3.textContent = 'バナナ';
}
