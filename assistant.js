var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent
var grammar = '#JSGF V1.0;'

var recognition = new SpeechRecognition();
var speechRecognitionList = new SpeechGrammarList();
speechRecognitionList.addFromString(grammar, 1);
recognition.grammars = speechRecognitionList;
recognition.continuous = false;
recognition.lang = 'en-US';
recognition.interimResults = false;
recognition.maxAlternatives = 2;

var recognition2 = new SpeechRecognition();
var speechRecognitionList2 = new SpeechGrammarList();
speechRecognitionList2.addFromString(grammar, 1);
recognition2.grammars = speechRecognitionList2;
recognition2.continuous = false;
recognition2.lang = 'en-US';
recognition2.interimResults = false;
recognition2.maxAlternatives = 2;

function rec() {
	document.getElementById('anim1').style.animation="woong 1.5s infinite"
	document.getElementById('anim2').style.animation="woong-2 1.5s infinite"
	document.getElementById('as').style.animation="openas"
  recognition.start();
}

recognition.onresult = function(event) {
  var text = event.results[0][0].transcript;
  document.getElementById('user').style.display = "block";
  document.getElementById('question').innerHTML = text;
  
  if (text.includes("repeat")) {
	  var rep = text.replace("repeat ", " ");
	  speak(rep);
	  return;
  }
  if (text.includes("search")) {
	  var s = text.replace("search", " ");
	  window.open("https://www.google.com/search?q=" + s, '_blank');
	 speak("I redirect you to what I found on" + s);
	  return;
  }
  if (text.includes("learn")) {
	  speak("I recomend you the channel Lion TV Tutorials");  
	  return;
	  }
  if (text.includes("name") && text.includes("my")) {
	 speak("You are" + getCookie("un"));
	  return;
  }
  if (text.includes("name") && text.includes("my") == false) {
	 speak("My name is Alex and I'm your virtual assistant!");
	  return;
  }
  if (text.includes("about") || text.includes("Alex")) {
	  document.getElementById("yes").style.display = "block";
	  document.getElementById("no").style.display = "block";
	 speak("Do you want to go to the about page?");
	  document.getElementById("yes").onclick = function() {
		  window.open("index.php", '_blank');
		}
	  document.getElementById("no").onclick = function() {
		 speak("I'll not redirect you to the about page");
		}
	 
	return;
  }
  if (text.includes("hi") || text.includes("hello")) {
	 speak("Hello How are you?");
	  return;
  }
  if (text.includes("thank")) {
	 speak("You're wellcome! I'm here to help you");
	  return;
  }
  if (text.includes("favourite") || text.includes("like")) {
	  if (text.includes("eat") || text.includes("food")) {
		 speak("My favourite food is pizza, but I can't eat it.");
		  return;
	  }
	  if (text.includes("do")) {
		 speak("I like to help you out in the new Alex OS.");
		  return;
	  }
	  if (text.includes("sport")) {
		 speak("I love Tennis, but I can't play it.");
		  return;
	  }
	  if (text.includes("person")) {
		 speak("Alex Sofonea, because he created me!");
		  return;
	  }
	  if (text.includes("location")) {
		 speak("Sibiu Romania");
		  return;
	  }
	  return;
  }
  if (text.includes("you") && text.includes("how")) {
	 speak("I'm fine! What about you?");
	  return;
  }
  if (text.includes("joke")) {
	 speak("KnockKnock! Who's there? Control Freak! Cont trol? Okay, now you say, ControlFreak who?");
	  return;
  }
  if (text.includes("do ")) {
	 speak("I can help you out to use Alex OS, open apps, tell you jokes and more. If you want more, check for future updates!");
	  return;
  }
  if (text.includes("help")) {
	  if (text.includes("settings")) {
		 speak("You need to open the settings app by pressing on that icon. By clicking on the switches, you can determen what do you want to have in Alex OS.");
		  return;
	  }
	  if (text.includes("calendar")) {
		 speak("In this app yu have the same calendar like in your phone or other divices. The hilighted day is today.");
		  return;
	  }
	  if (text.includes("camera")) {
		 speak("Sorry, but the camera app doesn't work correctley. Plese check for future updates!");
		  return;
	  }
	  if (text.includes("web")) {
		 speak("You need to press the new button. In the new page, you need to press on the plus icon and add elements to your website.");
		  return;
	  }
	  if (text.includes("map")) {
		 speak("The mpas app works exactley like Google Maps!");
		  return;
	  }
	  if (text.includes("place")) {
		 speak("You can find which place you want in th Maps App!");
		  return;
	  }
	  if (n2 == false) {
		  document.getElementById("yes").style.display = "block";
		  document.getElementById("no").style.display = "block";
			speak("Should I search on google?");
		  document.getElementById("yes").onclick = function() {
			  var se = text.replace("help", " ");
			  se = se.replace("me ", " ");
			  window.open("https://www.google.com/search?q=" + se, '_blank');
			 speak("I redirect you to what I found on" + se);
			}
		  document.getElementById("no").onclick = function() {
			 speak("I'll not redirect you to google");
			}
	  }
	  return;
  }
  
  if (text.includes("background")) {
	  if (text.includes("one")) {
		  document.body.style.backgroundImage = "url('background1.jpeg')";
		 speak("I changed the background!");
		  return;
	  }
	  if (text.includes("two")) {
		  document.body.style.backgroundImage = "url('background2.jpeg')";
		 speak("I changed the background!");
		  return;
	  }
	  if (text.includes("three")) {
		  document.body.style.backgroundImage = "url('background3.jpeg')";
		 speak("I changed the background!");
		  return;
	  }
	  return;
  }
	speak("Should I search on google?");
  document.getElementById("yes").onclick = function() {
	  var se = text;
	  window.open("https://www.google.com/search?q=" + se, '_blank');
	 speak("I redirect you to what I found on" + se);
	}
  document.getElementById("no").onclick = function() {
	  speak("OK");
	}
}

recognition.onspeechend = function() {
  recognition.stop();
	document.getElementById('anim1').style.animation="spend 0.5s";
	document.getElementById('anim2').style.animation="spend 0.5s";
}

recognition.onnomatch = function(event) {
  diagnostic.textContent = "I didn't understand!";
}

recognition.onerror = function(event) {
  diagnostic.textContent = 'Error occurred in recognition: ' + event.error;
}

function speak(textS) {
    document.getElementById('alex').style.display = "block";
    document.getElementById('answer').innerHTML = textS;
	var msg = new SpeechSynthesisUtterance();
	msg.text = textS;
	window.speechSynthesis.speak(msg);
}

function ask() {
    recognition2.start();
	text = event.results[0][0].transcript;
}