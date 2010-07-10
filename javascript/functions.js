			function add(source_song) {
				helpWindow = window.open('/songs.php?action=info&ss='+source_song, 'Variations', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=300', false);
				helpWindow.focus();
				}