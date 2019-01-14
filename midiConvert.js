/*
    to use the functions
    these following scripts need to be included
    <!-- midi.js css -->
    <link href="./css/MIDIPlayer.css" rel="stylesheet" type="text/css" />
    <!-- shim -->
    <script src="../inc/shim/Base64.js" type="text/javascript"></script>
    <script src="../inc/shim/Base64binary.js" type="text/javascript"></script>
    <script src="../inc/shim/WebAudioAPI.js" type="text/javascript"></script>
    <script src="../inc/shim/WebMIDIAPI.js" type="text/javascript"></script>
    <!-- jasmid package -->
    <script src="../inc/jasmid/stream.js"></script>
    <script src="../inc/jasmid/midifile.js"></script>
    <script src="../inc/jasmid/replayer.js"></script>
    <!-- midi.js package -->
    <script src="../js/midi/audioDetect.js" type="text/javascript"></script>
    <script src="../js/midi/gm.js" type="text/javascript"></script>
    <script src="../js/midi/loader.js" type="text/javascript"></script>
    <script src="../js/midi/plugin.audiotag.js" type="text/javascript"></script>
    <script src="../js/midi/plugin.webaudio.js" type="text/javascript"></script>
    <script src="../js/midi/plugin.webmidi.js" type="text/javascript"></script>
    <script src="../js/midi/player.js" type="text/javascript"></script>
    <script src="../js/midi/synesthesia.js" type="text/javascript"></script>
    <!-- utils -->
    <script src="../js/util/dom_request_xhr.js" type="text/javascript"></script>
    <script src="../js/util/dom_request_script.js" type="text/javascript"></script>
    <!-- includes -->
    <script src="./inc/timer.js" type="text/javascript"></script>
    <script src="./inc/colorspace.js" type="text/javascript"></script>
    <script src="./inc/event.js" type="text/javascript"></script>
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