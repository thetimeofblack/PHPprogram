/*
    to use the functions
    these following scripts need to be included
    <!-- midi.js css -->
    <link href="./examples/css/MIDIPlayer.css" rel="stylesheet" type="text/css" />
    <!-- shim -->
    <script src="./inc/shim/Base64.js" type="text/javascript"></script>
    <script src="./inc/shim/Base64binary.js" type="text/javascript"></script>
    <script src="./inc/shim/WebAudioAPI.js" type="text/javascript"></script>
    <script src="./inc/shim/WebMIDIAPI.js" type="text/javascript"></script>
    <!-- jasmid package -->
    <script src="./inc/jasmid/stream.js"></script>
    <script src="./inc/jasmid/midifile.js"></script>
    <script src="./inc/jasmid/replayer.js"></script>
    <!-- midi.js package -->
    <script src="./js/midi/audioDetect.js" type="text/javascript"></script>
    <script src="./js/midi/gm.js" type="text/javascript"></script>
    <script src="./js/midi/loader.js" type="text/javascript"></script>
    <script src="./js/midi/plugin.audiotag.js" type="text/javascript"></script>
    <script src="./js/midi/plugin.webaudio.js" type="text/javascript"></script>
    <script src="./js/midi/plugin.webmidi.js" type="text/javascript"></script>
    <script src="./js/midi/player.js" type="text/javascript"></script>
    <script src="./js/midi/synesthesia.js" type="text/javascript"></script>
    <!-- utils -->
    <script src="./js/util/dom_request_xhr.js" type="text/javascript"></script>
    <script src="./js/util/dom_request_script.js" type="text/javascript"></script>
    <!-- includes -->
    <script src="./examples/inc/timer.js" type="text/javascript"></script>
    <script src="./examples/inc/colorspace.js" type="text/javascript"></script>
    <script src="./examples/inc/event.js" type="text/javascript"></script>
 */



/**
 * convert hex string into binary
 * @param content
 * @returns {string}
 */
var getBinContent = function(content)
{
    var midiBin = content.split(' ');
    var text = "";
    for(var i = 0; i<midiBin.length; i++)
    {

        var temp = "0x" + midiBin[i];
        text += String.fromCharCode(temp);
    }
    return text;
}

/**
 * load the content to midi player
 * @param content
 */
var loadMidiContent = function(content)
{
    MIDI.loader = new sketch.ui.Timer;
    MIDI.loadPlugin({
        soundfontUrl: "./soundfont/",
        onprogress: function (state, progress) {
            MIDI.loader.setValue(progress * 100);
        }
    })
    var midiContent = getBinContent(content);
    player = MIDI.Player;
    player.currentData = midiContent;
}

/**
 * control the midi player whether to play or resume
 */
var play = function ()
{
    if(!player.playing)
    {
        player.loadMidiFile(player.start());
    }
    else
    {
        player.resume();
    }
    // document.getElementById("playButton").innerHTML = "click to play";
    // alert(player.playing);
}

/**
 * control the midi player to pause
 */
var pause = function()
{
    player.pause(true);
    // document.getElementById("playButton").innerHTML = "click to resume";
}

/**
 * control the midi player to stop
 */
var stop = function()
{
    player.stop();
    document.getElementById("playButton").innerHTML = "click to play";
}

/**
 * assemble the content
 */
var loadAndPlay = function()
{
    var melLength = (melStr + endStr).length / 3;
    melLength = formatLength(melLength);
    var choLength = (choStr + endStr).length / 3;
    choLength = formatLength(choLength);
    var content = Str + melHead + melLength + melStr + endStr + choHead + choLength + choStr + endStr;
    loadMidiContent(content);
    contentLoaded = true;
}

/**
 * format the byte length of melody and chords
 * @param length
 * @returns {*}
 */
var formatLength = function(length)
{
    leng1 = length & parseInt("0xff000000");
    leng1 = leng1 >> 24;
    leng2 = length & parseInt("0x00ff0000");
    leng2 = leng2 >> 16;
    leng3 = length & parseInt("0x0000ff00");
    leng3 = leng3 >> 8;
    leng4 = length & parseInt("0x000000ff");
    length = leng1.toString(16) + " " + leng2.toString(16) + " " + leng3.toString(16) + " " + leng4.toString(16) + " ";
    return length;
}