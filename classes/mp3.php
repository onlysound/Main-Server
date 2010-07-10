<?

class mp3{
	var $id3_genres_array = array(
            'Blues', 'Classic Rock', 'Country', 'Dance', 'Disco', 'Funk', 'Grunge', 'Hip-Hop', 'Jazz', 'Metal', 'New Age', 'Oldies', 'Other', 'Pop', 'R&B', 'Rap', 'Reggae', 'Rock', 'Techno', 'Industrial',
            'Alternative', 'Ska', 'Death Metal', 'Pranks', 'Soundtrack', 'Euro-Techno', 'Ambient', 'Trip-Hop', 'Vocal', 'Jazz+Funk', 'Fusion', 'Trance', 'Classical', 'Instrumental', 'Acid', 'House',
            'Game', 'Sound Clip', 'Gospel', 'Noise', 'AlternRock', 'Bass', 'Soul', 'Punk', 'Space', 'Meditative', 'Instrumental Pop', 'Instrumental Rock', 'Ethnic', 'Gothic', 'Darkwave',
            'Techno-Industrial', 'Electronic', 'Pop-Folk', 'Eurodance', 'Dream', 'Southern Rock', 'Comedy', 'Cult', 'Gangsta', 'Top 40', 'Christian Rap', 'Pop/Funk', 'Jungle', 'Native American', 'Cabaret',
            'New Wave', 'Psychadelic', 'Rave', 'Showtunes', 'Trailer', 'Lo-Fi', 'Tribal', 'Acid Punk', 'Acid Jazz', 'Polka', 'Retro', 'Musical', 'Rock & Roll', 'Hard Rock', 'Folk', 'Folk/Rock', 'National Folk',
            'Swing', 'Fast Fusion', 'Bebob', 'Latin', 'Revival', 'Celtic', 'Bluegrass', 'Avantgarde', 'Gothic Rock', 'Progressive Rock', 'Psychedelic Rock', 'Symphonic Rock', 'Slow Rock', 'Big Band',
            'Chorus', 'Easy Listening', 'Acoustic', 'Humour', 'Speech', 'Chanson', 'Opera', 'Chamber Music', 'Sonata', 'Symphony', 'Booty Bass', 'Primus', 'Porn Groove', 'Satire', 'Slow Jam', 'Club', 'Tango', 'Samba',
            'Folklore', 'Ballad', 'Power Ballad', 'Rhythmic Soul', 'Freestyle', 'Duet', 'Punk Rock', 'Drum Solo', 'Acapella', 'Euro-house', 'Dance Hall'
        );
	var $info_bitrates = array(
            1    =>    array(
                1    =>    array( 0 => 0, 16 => 32, 32 => 64, 48 => 96, 64 => 128, 80 => 160, 96 => 192, 112 => 224, 128 => 256, 144 => 288, 160 => 320, 176 => 352, 192 => 384, 208 => 416, 224 => 448, 240 => false),
                2    =>    array( 0 => 0, 16 => 32, 32 => 48, 48 => 56, 64 =>  64, 80 =>  80, 96 =>  96, 112 => 112, 128 => 128, 144 => 160, 160 => 192, 176 => 224, 192 => 256, 208 => 320, 224 => 384, 240 => false),
                3    =>    array( 0 => 0, 16 => 32, 32 => 40, 48 => 48, 64 =>  56, 80 =>  64, 96 =>  80, 112 =>  96, 128 => 112, 144 => 128, 160 => 160, 176 => 192, 192 => 224, 208 => 256, 224 => 320, 240 => false)
            ),
            2    =>    array(
                1    =>    array( 0 => 0, 16 => 32, 32 => 48, 48 => 56, 64 =>  64, 80 => 80, 96 => 96, 112 => 112, 128 => 128, 144 => 144, 160 => 160, 176 => 176, 192 => 192, 208 => 224, 224 => 256, 240 => false),
                2    =>    array( 0 => 0, 16 =>  8, 32 => 16, 48 => 24, 64 =>  32, 80 => 40, 96 => 48, 112 =>  56, 128 =>  64, 144 =>  80, 160 =>  96, 176 => 112, 192 => 128, 208 => 144, 224 => 160, 240 => false),
                3    =>    array( 0 => 0, 16 =>  8, 32 => 16, 48 => 24, 64 =>  32, 80 => 40, 96 => 48, 112 =>  56, 128 =>  64, 144 =>  80, 160 =>  96, 176 => 112, 192 => 128, 208 => 144, 224 => 160, 240 => false)
            )
        );
	var $info_versions = array(0 => "reserved", 1 => "MPEG Version 1", 2 => "MPEG Version 2", 2.5 => "MPEG Version 2.5");
	var $info_layers = array("reserved", "Layer I", "Layer II", "Layer III");
    var $info_sampling_rates = array(
		0        =>    array(0 => false, 4 => false, 8 => false, 12 => false),
        1        =>    array(0 => "44100 Hz", 4 => "48000 Hz", 8 => "32000 Hz", 12 => false),
        2        =>    array(0 => "22050 Hz", 4 => "24000 Hz", 8 => "16000 Hz", 12 => false),
        2.5    =>    array(0 => "11025 Hz", 4 => "12000 Hz", 8 => "8000 Hz", 12 => false)
  	);
    var $info_channel_modes = array(0 => "stereo", 64 => "joint stereo", 128 => "dual channel", 192 => "single channel");
    var $file = "";
    var $fh = false;
    var $error = false;
    var $id3_parsed = false;
    var $id3 = array(
/*          "tag"            =>    "",
            "title"        =>    "unknown",
            "author"        =>    "unknown",
            "album"        =>    "unknown",
            "year"        =>    "unknown",
            "comment"    =>    "unknown",
            "genre_id"    =>    0,
            "genre"        =>    "unknown"
*/  );
    var $info = array();

    function mp3($file, $exitonerror=true) {

    	$file=rawurldecode($file);
        if (file_exists($file)) {
        	$this->file = $file;
         	$this->fh = fopen($this->file,"r");
            global $HTTP_HOST, $PHP_SELF;
        } else {
        	$this->error = "NO_SUCH_FILE";
            if ($exitonerror) $this->exitonerror();
        }
//            $this->get_id3v2header();
        $second = $this->synchronize();

//            echo("2nd byte = $second <b>" . decbin($second) . "</b><br>");
        $third = ord(fread($this->fh, 1));
        $fourth = ord(fread($this->fh, 1));
        $this->info['second']=$second;
        $this->info['third']=$third;
        $this->info['fourth']=$fourth;
        $this->info["version_id"] = ($second & 16) > 0 ? ( ($second & 8) > 0 ? 1 : 2 ) : ( ($second & 8) > 0 ? 0 : 2.5 );
        $this->info["version"] = $this->info_versions[ $this->info["version_id"] ];
        $this->info["layer_id"] = ($second & 4) > 0 ? ( ($second & 2) > 0 ? 1 : 2 ) : ( ($second & 2) > 0 ? 3 : 0 );
        $this->info["layer"] = $this->info_layers[ $this->info["layer_id"] ];
        $this->info["protection"] = ($second & 1) > 0 ? "no CRC" : "CRC";
        $this->info["sampling_rate"] = $this->info_sampling_rates[ $this->info["version_id"] ][ ($third & 12)];
        $this->info["padding"] = ($third & 2) > 0 ? "on" : "off";
        $this->info["private"] = ($third & 1) > 0 ? "on" : "off";
        $this->info["channel_mode"] = $this->info_channel_modes[$fourth & 192];
        $this->info["copyright"] = ($fourth & 8) > 0 ? "on" : "off";
        $this->info["original"] = ($fourth & 4) > 0 ? "on" : "off";

        $this->id3_parsed = true;
        fseek($this->fh, -128, SEEK_END);
        $line = fread($this->fh, 10000);
		if (preg_match("/^TAG/", $line)) {
        	$this->id3 = unpack("a3tag/a30title/a30author/a30album/a4year/a30comment/C1genre_id", $line);
            $this->id3["genre"] = $this->id3_genres_array[$this->id3["genre_id"]];
            $this->id3["filesize"] = filesize($this->file);
            $this->id3["bitrate"] = $this->info_bitrates[ $this->info["version_id"] ][ $this->info["layer_id"] ][ ($third & 240) ];
			if(!is_null($this->id3["bitrate"]) and $this->id3["bitrate"]!=0){
				$this->id3["length"] = $this->calculate_length();
			}
			else{
				$this->id3["bitrate"]=0;
				$this->id3["length"] = 0;
			}
		} else {
		    $this->error = "no idv3 tag found";
        }
    }
    function exitonerror() {
    	//echo($this->error);
    	exit;
    }
    function set_id3($title = "", $author = "", $album = "", $year = "", $comment = "", $genre_id = 0) {
    	$this->error = false;
    	$this->wfh = fopen($this->file,"a");
    	fseek($this->wfh, -128, SEEK_END);
	    fwrite($this->wfh, pack("a3a30a30a30a4a30C1", "TAG", $title, $author, $album, $year, $comment, $genre_id), 128);
        fclose($this->wfh);
    }
    function get_id3() {
    	return $this->id3;
	}
        // get_info() helper methods
	function calculate_length() {
    	$length = floor(($this->id3["filesize"]) / $this->id3["bitrate"] * 0.008);
        return($length);
	}
    function get_info() {

    	  return $this->info;
	}
	function synchronize() {
		$finished = false;
		rewind($this->fh);
		$trash=fread($this->fh, 300);
		while (!$finished) {
			do{
            	$skip = ord(fread($this->fh, 1));
//                    echo("inside synchronize() skip = $skip <b>" . decbin($skip) . "</b><br>");
			}while ($skip != 255 && !feof($this->fh));

        	if (feof($this->fh)) {
            	$this->error="NO_HEADER";
                //if ($exitonerror) $this->exitonerror();
			}
            $store = ord(fread($this->fh, 1));
//                echo("inside synchronize() store = $store <b>" . decbin($store) . "</b><br>");
            if ($store >= 225) {
                $finished = true;
            } else if (feof($this->fh)) {
            	$this->error="NO_HEADER";
                if ($exitonerror) $this->exitonerror();
            }
		}
        return($store);
	}
    function get_id3v2header() {
    	$bytes = fread($this->fh, 3);
        if ($bytes != "ID3") {
        	echo("no ID3 tag");
            return(false);
        }
            // get major and minor versions
        $major = fread($this->fh, 1);
        $minor = fread($this->fh, 1);
        //echo("ID3v$major.$minor");
    }
    function close() {
    	@fclose($this->fh);
    }
}

?>
