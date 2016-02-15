var shared = {};

	shared.init = function(){
		// prevent closing of a dropdown on form click
		$('.dropdown-menu').find(':not(a)').click(function (e) {
		    e.stopPropagation();
		});
	}

	shared.getFeaturedPhotos = function(albumId){
		var flickerAPI = "https://api.flickr.com/services/rest/?method=flickr.photosets.getPhotos&api_key=814d49bd1862a9aa6b4628a1824de7c9&photoset_id=" + albumId + "&user_id=53329065%40N03&extras=tags%2C+url_m&media=photos&format=json&nojsoncallback=1";
		return $.getJSON( flickerAPI, function(data){
			var featuredPhotos = [],
				i,
				photo;
			for(i=0; i<data.photoset.photo.length; i++) {
				photo = data.photoset.photo[i];
				if(photo.tags.indexOf("featured") > -1){
					featuredPhotos.push(photo);
				}
			}
			shared.populatePhotos(featuredPhotos);
		});
	}

	shared.populatePhotos = function(featuredPhotos){
		var i,
			photo;

		for(i=0; i<featuredPhotos.length; i++) {
			photo = featuredPhotos[i];
			$('#images').append('<img src="' + photo.url_m + '"><br>');
		}
	}

$('document').ready(shared.init);