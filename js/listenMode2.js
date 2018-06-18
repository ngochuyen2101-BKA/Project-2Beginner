//Error: khong xu ly duoc dau xuong dong

//file nhan cac bien transcript, level, fileName tu chuong trinh php
var textArea = document.getElementById('textarea');
var totalWords = document.getElementById('totalWords');
var listenResult = document.getElementById('listenResult');

transcript = editParagraph(cutTranscript(transcript));

/* 
 * function nhan doan transcript lam tham so
 * function cat bo doan ki tu dung cho mode 1 (bat dau tu "--->")
 * va tra ve doan editTrancr moi
 */
function cutTranscript(transcript) {
	var editTrancr = "";
	var firstIndex = transcript.indexOf("--->");
	
	if (firstIndex != -1) {
		editTrancr = transcript.substring(0, firstIndex);
		return editTrancr;
	} else {
		return transcript;
	}
}

/* 
 * function nhan 1 doan van ban lam tham so
 * function tim tat ca ki tu khong phai la chu cai / chu so / dau cach/ dau '
 * va chuyen doi cac ki tu do thanh dau cach. Cac thay doi duoc luu trong 1 
 * doan editPraragr moi
 */
function editParagraph(paragr){
	var editParagr = "";
	var firstIndex = 0;
	var lastIndex = 0;
	var lengthParagr = paragr.length;
	
	for (; lastIndex < lengthParagr;){
		if (checkOtherCharacter(paragr.charAt(lastIndex))){
			editParagr += paragr.substring(firstIndex, lastIndex);;
			
			//quet qua cac ki tu loai bo tiep theo (neu co);
			do {
				lastIndex ++;
				if (lastIndex >= lengthParagr)
					break;
			} while(checkOtherCharacter(paragr.charAt(lastIndex)));
			firstIndex = lastIndex;	
		}
		else{
			lastIndex ++;
			if (lastIndex == lengthParagr)
				editParagr += paragr.substring(firstIndex, lastIndex);
		}
	}
	return editParagr;
}

/* 
 * function duoc goi khi nut Submit duoc click
 * function dua ra ket qua so sanh giua transcript va doan text
 * nguoi dung da nhap vao
 */

function checkSentences(){
	var textInput = textArea.value;
	
	textInput = editParagraph(textInput);
	
	//xoa cac dau cach, dau xuong dong neu co o cuoi cac doan van
	transcript = transcript.replace(/\s*$/,"");
	textInput = textInput.replace(/\s*$/,"");
	
	compareText(transcript, textInput);
}

/* 
 * function kiem tra 1 ki tu co phai la chu cai / chu so / dau cach/ dau '
 * function tra ve true neu khong phai loai nao o ben tren, false neu nguoc lai
 * thu tu kiem tra duoc sap xep theo muc do xuat hien
 */
function checkOtherCharacter(character){
	if (character >= 'a' && character <= 'z')
		return false;
	if (character >= 'A' && character <= 'Z')
		return false;
	if (character == ' ')
		return false;
	if (character >= '0' && character <= '9')
		return false;
	if (character == '\'')
		return false;
	
	return true;
}

/* 
 * function dua ra ket qua so sanh 2 doan van ban theo tung tu
 * neu tu cua 2 van ban o cung 1 vi tri co noi dung giong nhau thi 
 * Ket qua duoc tinh theo xau con chung dai nhat va thang diem 100
 */

function compareText(para1, para2){
	
	var list1 = para1.toUpperCase().split(' ');
	var list2 = para2.toUpperCase().split(' ', list1.length);		//so tu cua list2 khong lon hon cua list1
	
	//nap thong tin cho input totalWords
	totalWords.value = list1.length.toString();
	
	var rows = list1.length + 1;
	var cols = list2.length + 1;
	var arrayTest = [];
	
	for (var index = 0; index < (rows * cols); index ++){
		arrayTest.push(0);
	}
	
	for (var indexRow = 1; indexRow < rows; indexRow ++){
		for (var indexCol = 1; indexCol < cols; indexCol ++){
			position = indexRow * cols + indexCol;
			if (list1[indexRow - 1] == list2[indexCol - 1]){
				arrayTest[position] = arrayTest[(indexRow - 1) * cols + (indexCol-1)] + 1;
			}
			else{
				var value1 = arrayTest[(indexRow-1) * cols + indexCol];
				var value2 = arrayTest[indexRow * cols + (indexCol-1)];
				arrayTest[position] = Math.max(value1, value2);
			}
		}
	}
	
	//nap thong tin cho input listenResult
	listenResult.value =  arrayTest[rows*cols - 1].toString();
}