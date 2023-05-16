var CN_TEXT_TO_SPEECH_RATE = 1; // The higher the rate, the faster the bot will speak
var CN_TEXT_TO_SPEECH_PITCH = 1; // This will alter the pitch for the bot's voice

// Indicate a locale code such as 'fr-FR', 'en-US', to use a particular language for the speech recognition functionality (when you speak into the mic)
// If you leave this blank, the system's default language will be used
var CN_WANTED_LANGUAGE_SPEECH_REC = ""; //"fr-FR";

// Determine which word will cause this scrip to stop.
var CN_SAY_THIS_WORD_TO_STOP = "stop";

// Determine which word will cause this script to temporarily pause
var CN_SAY_THIS_WORD_TO_PAUSE = "pause";

// Do we keep listening even when paused, so that we can resume by a vocal command?
var CN_KEEP_LISTENING = true;

// Determine whether messages are sent immediately after speaing
var CN_AUTO_SEND_AFTER_SPEAKING = false;

// Determine whether commas should be ignored as sentence separators
var CN_IGNORE_COMMAS = false;

// Determine which word(s) will cause this script to send the current message (if auto-send disabled)
var CN_SAY_THIS_TO_SEND = "send message now"; 

// Indicate "locale-voice name" (the possible values are difficult to determine, you should just ignore this and use the settings menu instead)
var CN_WANTED_VOICE_NAME = "";

// Ignore code blocks - anything contained in <pre>
var CN_IGNORE_CODE_BLOCKS = false;

// Use ElevenLabs for TTS
var CN_TTS_ELEVENLABS = false;

// ElevenLabs API key
var CN_TTS_ELEVENLABS_APIKEY = "";

// ElevenLabs voice
var CN_TTS_ELEVENLABS_VOICE = "";

// Statically list ElevenLabs models (easier than to request from API)
var CN_TTS_ELEVENLABS_MODELS = {"eleven_monolingual_v1": "English only", "eleven_multilingual_v1": "Multi-language (autodetect)"};

// Other ElevenLabs settings
var CN_TTS_ELEVENLABS_STABILITY = "";
var CN_TTS_ELEVENLABS_SIMILARITY = "";




// -------------------
// CODE (DO NOT ALTER)
// -------------------
var CN_MESSAGE_COUNT = 0;
var CN_CURRENT_MESSAGE = null;
var CN_CURRENT_MESSAGE_SENTENCES = [];
var CN_CURRENT_MESSAGE_SENTENCES_NEXT_READ = 0;
var CN_SPEECHREC = null;
var CN_IS_READING = false;
var CN_IS_LISTENING = false;
var CN_FINISHED = false;
var CN_PAUSED = false;
var CN_WANTED_VOICE = null;
var CN_TIMEOUT_KEEP_SYNTHESIS_WORKING = null;
var CN_TIMEOUT_KEEP_SPEECHREC_WORKING = null;
var CN_SPEECH_REC_SUPPORTED = false;
var CN_SPEAKING_DISABLED = false;
var CN_SPEECHREC_DISABLED = false;
var CN_CONVERSATION_SUSPENDED = false;
var CN_BAR_COLOR_FLASH_GREY = false;
var CN_TTS_ELEVENLABS_QUEUE = [];
var CN_IS_CONVERTING = false;
var CN_IS_PLAYING = false;
var CN_CURRENT_AUDIO = null;







// Check we are on the correct page
function CN_CheckCorrectPage() {
	console.log("Checking we are on the correct page...");
	var wrongPage = jQuery("textarea.w-full").length == 0; // no textarea... login page?
	
	if (wrongPage) {
		// We are on the wrong page, keep checking
		setTimeout(CN_CheckCorrectPage, 1000);
	} else {
		// We are on the right page, let's go!
		CN_InitScript();
	}
}

// Perform initialization after jQuery is loaded
function CN_InitScript() {



  // Add box
	jQuery("body").append(
		"<div style='position: fixed; top: 10px; right: 67%; display: inline-block; " +
			"background: rgb(43 102 102); color: white; padding: 0; font-size: 16px; border-radius: 8px; text-align: center;" +
			"cursor: move; font-weight: bold; z-index: 1111;' id='TTGPTSettings2'>" +
			// Logo / title
			"<div style='padding: 4px 40px; border-bottom: 1px solid grey;'>" +
				"<p style='display: inline-block; font-size: 20px; line-height: 80%; padding: 8px 0;'>PEPE BUTTON<br />" +
				"</p>" +
			"</div>" +
			// Below logo
			"<div>" +
				// Start button
				"<div style='font-size: 16px; padding: 8px;' class='CNStartZone'>" +
          "<button style='border: 2px solid grey; padding: 6px 40px; margin: 6px; border-radius: 6px; opacity: 0.7;' id='LeerButton' title='ALT+SHIFT+S'><i class=\"fa-solid fa-book-open\"></i>&nbsp;&nbsp;LEER</button>" +
					"<button style='border: 2px solid grey; padding: 6px 40px; margin: 6px; border-radius: 6px; opacity: 0.7;' id='PepeButton' title='ALT+SHIFT+S'><i class=\"fa-solid fa-play\"></i>&nbsp;&nbsp;ENVIAR</button>"+
				"</div>"+
		  "</div>" +
    "</div>"
	);


	setTimeout(function () {
		// Try and get voices
		// speechSynthesis.getVoices();

		// Make icons clickable
		//jQuery(".CNToggle").css("cursor", "pointer");
		//jQuery(".CNToggle").on("click", CN_ToggleButtonClick);
		jQuery("#LeerButton").on("click", CN_StartTTGPT);
		jQuery("#PepeButton").on("click", function() {
      CN_SendMessage("gracias, parece que funciona bien.");
    });
		//jQuery("#CNResumeButton").on("click", CN_ResumeAfterSuspension);
		
		// Make icons change opacity on hover
		jQuery(".CNToggle, #PepeButton, #CNResumeButton").on("mouseenter", function() { jQuery(this).css("opacity", 1); });
		jQuery(".CNToggle, #PepeButton, #CNResumeButton").on("mouseleave", function() { jQuery(this).css("opacity", 0.7); });
		// jQuery(document).on("mouseenter", ".TTGPTSave, .TTGPTCancel", function() { jQuery(this).css("opacity", 1); } );
		// jQuery(document).on("mouseleave", ".TTGPTSave, .TTGPTCancel", function() { jQuery(this).css("opacity", 0.7); } );
		
		// Make TTGPTSettings draggable
		jQuery("#TTGPTSettings2").mousedown(function(e) {
			window.my_dragging = {};
			my_dragging.pageX0 = e.pageX;
			my_dragging.pageY0 = e.pageY;
			my_dragging.elem = this;
			my_dragging.offset0 = $(this).offset();
			function handle_dragging(e) {
				var left = my_dragging.offset0.left + (e.pageX - my_dragging.pageX0);
				var top = my_dragging.offset0.top + (e.pageY - my_dragging.pageY0);
				jQuery(my_dragging.elem).css('right', '');
				jQuery(my_dragging.elem)
					.offset({top: top, left: left});
			}
			function handle_mouseup(e) {
				jQuery('body')
					.off('mousemove', handle_dragging)
					.off('mouseup', handle_mouseup);
			}
			jQuery('body')
				.on('mouseup', handle_mouseup)
				.on('mousemove', handle_dragging);
		});


		// AI voice settings: voice/language, rate, pitch
		var wantedVoiceIndex = 7;
		var allVoices = speechSynthesis.getVoices();
		CN_WANTED_VOICE = allVoices[wantedVoiceIndex];
		CN_WANTED_VOICE_NAME = CN_WANTED_VOICE.lang+"-"+CN_WANTED_VOICE.name;
		CN_TEXT_TO_SPEECH_RATE = Number( 1 );
		CN_TEXT_TO_SPEECH_PITCH = Number( 1 );


	}, 100);


  
}

// Send a message to the bot (will simply put text in the textarea and simulate a send button click)
function CN_SendMessage(text) {

  console.log("asdsaasdasdasd");

	// Put message in textarea
	jQuery("textarea.w-full").focus();
	var existingText = jQuery("textarea.w-full").val();
	
	// Is there already existing text?
	if (!existingText) jQuery("textarea.w-full").val(text);
	else jQuery("textarea.w-full").val(existingText+" "+text);
	
	// Change height in case
	var fullText = existingText+" "+text;
	var rows = Math.ceil( fullText.length / 88);
	var height = rows * 24;
	jQuery("textarea.w-full").css("height", height+"px");
	
	// Send the message, if autosend is enabled
	jQuery("textarea.w-full").closest("div").find("button").prop("disabled", false);
	if (CN_AUTO_SEND_AFTER_SPEAKING) {
		jQuery("textarea.w-full").closest("div").find("button").click();
		
		
	} else {
		
	}
}









// This function will say the given text out loud using the browser's speech synthesis API, or send the message to the ElevenLabs conversion stack
function CN_SayOutLoud(text) {
	// Have we no text to say? Or did we disable text-to-speech? Make sure to continue listening, if that's what we want
	if (!text || CN_SPEAKING_DISABLED) {
		if (CN_SPEECH_REC_SUPPORTED && CN_SPEECHREC && !CN_IS_LISTENING && !CN_PAUSED && !CN_SPEECHREC_DISABLED && !CN_IS_READING) CN_SPEECHREC.start();
		clearTimeout(CN_TIMEOUT_KEEP_SPEECHREC_WORKING);
		CN_TIMEOUT_KEEP_SPEECHREC_WORKING = setTimeout(CN_KeepSpeechRecWorking, 100);
		return;
	}
	
	// Are we speaking?
	if (CN_SPEECHREC) {
		clearTimeout(CN_TIMEOUT_KEEP_SPEECHREC_WORKING);
		CN_SPEECHREC.stop();
	}
	
	// Let's speak out loud with the browser's text-to-speech API
	console.log("[BROWSER] Saying out loud: " + text);
	var msg = new SpeechSynthesisUtterance();
	msg.text = text;
	
	if (CN_WANTED_VOICE) msg.voice = CN_WANTED_VOICE;
	msg.rate = CN_TEXT_TO_SPEECH_RATE;
	msg.pitch = CN_TEXT_TO_SPEECH_PITCH;
	msg.onstart = () => {
		// Make border green
		$("#TTGPTSettings2").css("background", "green");
		
		// If speech recognition is active, disable it
		if (CN_IS_LISTENING) CN_SPEECHREC.stop();
		
		if (CN_FINISHED) return;
		CN_IS_READING = true;
		//clearTimeout(CN_TIMEOUT_KEEP_SYNTHESIS_WORKING);
		//CN_TIMEOUT_KEEP_SYNTHESIS_WORKING = setTimeout(CN_KeepSpeechSynthesisActive, 5000);
	};
	msg.onend = () => {
		CN_AfterSpeakOutLoudFinished();
	}
	CN_IS_READING = true;
	window.speechSynthesis.speak(msg);
}
// This is a workaround for Chromium's bug in the speech synthesis API (https://stackoverflow.com/questions/21947730/chrome-speech-synthesis-with-longer-texts)
function CN_KeepSpeechSynthesisActive() {
	console.log("Keeping speech synthesis active...");
	window.speechSynthesis.pause();
	window.speechSynthesis.resume();
	CN_TIMEOUT_KEEP_SYNTHESIS_WORKING = setTimeout(CN_KeepSpeechSynthesisActive, 5000);
}

// Occurs when speaking out loud is finished
function CN_AfterSpeakOutLoudFinished() {
	if (CN_SPEECHREC_DISABLED) return;
	
	// Make border grey again
	$("#TTGPTSettings2").css("background", "rgb(43 102 102)");
	
	if (CN_FINISHED) return;
	
	// Finished speaking
	clearTimeout(CN_TIMEOUT_KEEP_SYNTHESIS_WORKING);
	console.log("Finished speaking out loud");
	
	// restart listening
	CN_IS_READING = false;

}






// Split the text into sentences so the speech synthesis can start speaking as soon as possible
function CN_SplitIntoSentences(text) {
	var sentences = [];
	var currentSentence = "";
	
	for(var i=0; i<text.length; i++) {
		//
		var currentChar = text[i];
		
		// Add character to current sentence
		currentSentence += currentChar;
		
		// is the current character a delimiter? if so, add current part to array and clear
		if (
			// Latin punctuation
		       currentChar == (CN_IGNORE_COMMAS?'.':',')
			|| currentChar == (CN_IGNORE_COMMAS ? '.' : ':')
			|| currentChar == '.' 
			|| currentChar == '!' 
			|| currentChar == '?' 
			|| currentChar == (CN_IGNORE_COMMAS ? '.' : ';')
			|| currentChar == '…'
			// Chinese/japanese punctuation
			|| currentChar == (CN_IGNORE_COMMAS ? '.' : '、')
			|| currentChar == (CN_IGNORE_COMMAS ? '.' : '，')
			|| currentChar == '。'
			|| currentChar == '．'
			|| currentChar == '！'
			|| currentChar == '？'
			|| currentChar == (CN_IGNORE_COMMAS ? '.' : '；')
			|| currentChar == (CN_IGNORE_COMMAS ? '.' : '：')
			) {
			if (currentSentence.trim() != "") sentences.push(currentSentence.trim());
			currentSentence = "";
		}
	}
	
	return sentences;
}

// Check for new messages the bot has sent. If a new message is found, it will be read out loud
function CN_CheckNewMessages() {
	// Any new messages?
	var currentMessageCount = jQuery(".text-base").length;
	if (currentMessageCount > CN_MESSAGE_COUNT) {
		// New message!
		console.log("New message detected! currentMessageCount: " + currentMessageCount);
		CN_MESSAGE_COUNT = currentMessageCount;
		CN_CURRENT_MESSAGE = jQuery(".text-base:last").find(".items-start");
		CN_CURRENT_MESSAGE_SENTENCES = []; // Reset list of parts already spoken
		CN_CURRENT_MESSAGE_SENTENCES_NEXT_READ = 0;
	}
	
	// Split current message into parts
	if (CN_CURRENT_MESSAGE && CN_CURRENT_MESSAGE.length) {
		var currentText = jQuery(".text-base:last").find(".items-start").text()+"";
		//console.log("currentText:" + currentText);
		
		// Remove code blocks?
		if (CN_IGNORE_CODE_BLOCKS) {
			currentText = jQuery(".text-base:last").find(".items-start").find(".markdown").contents().not("pre").text();
			//console.log("[CODE] currentText:" + currentText);
		}
		
		var newSentences = CN_SplitIntoSentences(currentText);
		if (newSentences != null && newSentences.length != CN_CURRENT_MESSAGE_SENTENCES.length) {
			//console.log("[NEW SENTENCES] newSentences:" + newSentences.length);
			
			// There is a new part of a sentence!
			var nextRead = CN_CURRENT_MESSAGE_SENTENCES_NEXT_READ;
			for (i = nextRead; i < newSentences.length; i++) {
				CN_CURRENT_MESSAGE_SENTENCES_NEXT_READ = i+1;

				var lastPart = newSentences[i];
				//console.log("Will say sentence out loud: "+lastPart);
				CN_SayOutLoud(lastPart);
			}
			CN_CURRENT_MESSAGE_SENTENCES = newSentences;
		}
	}
	
	setTimeout(CN_CheckNewMessages, 100);
}









// Start Talk-to-ChatGPT (Start button)
function CN_StartTTGPT() {
	// Play sound & start
	var snd = new Audio("data:audio/mpeg;base64,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");
	snd.play();
	CN_FINISHED = false;
	
	// Hide start button, show action buttons
	// jQuery(".CNStartZone").hide();
	// jQuery(".CNActionButtons").show();
	
	setTimeout(function() {
		// Start speech rec
		// CN_StartSpeechRecognition();
		
		// Make sure message count starts from last; we don't want to read the latest message
		var currentMessageCount = jQuery(".text-base").length;
		if (currentMessageCount > CN_MESSAGE_COUNT) {
			// New message!
			CN_MESSAGE_COUNT = currentMessageCount;
			CN_CURRENT_MESSAGE = null; // Set current message to null
		}
		
		// Check for new messages
		CN_CheckNewMessages();
	}, 250);
}




// MAIN ENTRY POINT
// Load jQuery, then run initialization function
(function () {
	
	setTimeout(function() {
		typeof jQuery == "undefined" ?
			alert("[Talk-to-ChatGPT] Sorry, but jQuery was not able to load. The script cannot run. Try using Google Chrome or Edge on Windows 11") :
			CN_CheckCorrectPage();
	}, 500);
	
})();