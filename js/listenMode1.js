/* Quy uoc: cac tu duoc chon an di se luon la tu dau tien xuat hien
			trong list word, cac tu duoc phan cach nhau bang dau phay
*/

/*
 * Su dung cac bien tu ben ngoai: hiddenWords - danh sach cac tu se duoc an di
								  transcirpt - doan transcript cua bai nghe
 */

var paragraph = document.getElementById('paragraph');
var listenResult = document.getElementById('listenResult');
var totalWords = document.getElementById('totalWords');

var mapList = [];
var inputWords = [];

sortHiddenWords();
totalWords.setAttribute('value', mapList.length.toString());
paragraph.innerHTML = makeParagraph(mapList);

//chuyen cac tu trong mapList thanh upperCase
for (var i = 0; i < mapList.length; i++) {
	mapList[i] = mapList[i].toUpperCase();
}

//Function phan tach doan transcript thanh editTranscriptipt (transcript thuc su) va mapList (chua cac tu)
function sortHiddenWords(){
	//phan chia cac tu trong hiddenWords vao mang tmpList - chua kiem tra su ton tai cua tu
	console.log(hiddenWords)
	var tmpList = hiddenWords.split(",");
	
	//tao list chua cac tu - chua sap xep theo thu tu xuat hien
	var list = [];
	checkList(transcript, list, tmpList);
	
	//tao mang mapList chua thu tu xuat hien cua cac tu trong list
	for ( var i = 0; i < list.length; i++) {	
		mapList.push(transcript.indexOf(list[i]));
	}
	
	mapList.sort(function(a,b){return a - b; });


	//sap xep lai cac tu theo thu tu xuat hien vao mang mapList
	for (var i = 0; i < list.length; i++) {
		for (var j = 0; j < mapList.length; j++) {
			if (typeof mapList[j] != "number") {
				continue;
			}
			
			if (transcript.indexOf(list[i]) == mapList[j]) {	
				mapList[j] = list[i];
			}
		}
	}
}

//Function tao doan van ban co cac input nhan ki tu nhap vao
function makeParagraph(listWord){
	var paragraph = "";
	var rawParagraph = "";
	var firstIndex = 0;
	var lastIndex = 0;
	
	//Cat doan transcript thanh 2 doan nho : doan truoc tu va doan sau tu
	//roi ghep cac doan lai voi 1 input o giua
	for (var i = 0; i < listWord.length; i++){
		//Cat lay doan truoc tu
		lastIndex = transcript.indexOf(listWord[i]);
		paragraph += transcript.substring(firstIndex, lastIndex);
		
		//Chen phan tu input
		paragraph += "<input class=\"inputWord\" id=\"input" + i +"\" type=\"text\" style=\"width: 100px;\" >";
		
		//Cat lay doan sau tu
		firstIndex = lastIndex + listWord[i].length;
		rawParagraph = transcript.substring(firstIndex);
	}
	
	paragraph += rawParagraph;
	return paragraph;
}

//function doi chieu 2 danh sach va thay doi gia tri
//cua listenValue
function checkWords() {
	takeInputWords();
	
	var rightAnswers = 0;
	
	for (var i = 0; i < inputWords.length; i++) {
		if (inputWords[i] == mapList[i]) {
			rightAnswers ++;
		}
	}
	
	listenResult.value = rightAnswers.toString();
}

//lay gia tri cua cac input nap vao mang inputWords
function takeInputWords() {
	var words = document.getElementsByClassName('inputWord');
	for (var i = 0; i < words.length; i++)
		inputWords.push(words[i].value.toUpperCase());
}

//Function copy cac word co ton tai tu tmpList vao list
function checkList (paragr, list, tmpList) {
	for (var i = 0; i < tmpList.length; i++) {	
		if (findWordPosition(paragr, tmpList, i, paragr.length) >= 0 ) {
			list.push(tmpList[i]);
		}
	}
}

//Function tim kiem cac tu tiep theo trung voi tu can an
function findWordPosition (paragr, list, index, longestLength){
	//lay vi tri xuat hien cua tu
	var position = paragr.indexOf(list[index]);
	
	//neu tu khong xuat hien trong doan van thi tra ve gia tri am
	if (position == -1) {
		return (- longestLength);
	}
	
	//neu tu la hop le thi tra ve vi tri goc
	//neu khong thi de quy tim kiem tu 
	if (checkInvalid(paragr, position, list[index].length)) {
		return position;
	}
	else {
		var subParagr = paragr.substring (position + list[index].length + 1);			//can cong 1 de tranh truong hop 2 tu giong het nhau duoc noi vao nhau
		return (position + findWordPosition(subParagr, list, index, longestLength));
	}
}

//Function kiem tra tu khong hop le trong list
function checkInvalid (paragr, position, wordLength){

	//kiem tra ki tu truoc va sau cua tu co phai la chu cai hay chu so hay khong
	if (checkLetter(paragr.charAt(position - 1))  
			|| checkLetter(paragr.charAt(position + wordLength))) {
				return false;
			}
	
	return true;
}

//Function kiem tra ki tu co phai la chu cai hoac chu so
function checkLetter (letter)
{
	if (letter.match(/[a-z]/i) || letter.match(/[A-Z]/i) || letter.match(/[0-9]/i))
		return true;
	return false;
}