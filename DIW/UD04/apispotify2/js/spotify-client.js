var client_id = "54daf2691cee41aab558f29651b04649";
var client_secret = "d21bd57ab1aa4529aae14522c474bad1";
var access_token = "";

//We create the Spotify class with the API to make the call to
function Spotify() {
  this.apiUrl = "https://api.spotify.com/";
}

//Search for information on an artist, adding the possibility of obtaining their albums.
Spotify.prototype.getArtist = function (artist) {
  $.ajax({
    type: "GET",
    url: this.apiUrl + "v1/search?type=artist&q=" + artist,
    headers: {
      Authorization: "Bearer " + access_token,
    },
  }).done(function (response) {
    $("#num_results").find("span").text(response.artists.total);
    $(response.artists.items).each(function (i, artist) {
      createArtistCard(artist);
    });
  });
};

//Search the albums of an artist, given the id of the artist
Spotify.prototype.getArtistById = function (artistId) {
  $.ajax({
    type: "GET",
    url: this.apiUrl + "v1/artists/" + artistId + "/albums",
    headers: {
      Authorization: "Bearer " + access_token,
    },
  }).done(function (response) {
    $("#num_results").find("span").text(response.total);
    $(response.items).each(function (i, album) {
      createAlbumsCard(album);
    });
    console.log(response);
  });
};

//This fragment is the first thing that is loaded, when the $(document).ready
$(function () {
  $.ajax({
    type: "POST",
    url: "https://accounts.spotify.com/api/token",
    beforeSend: function (xhr) {
      xhr.setRequestHeader(
        "Authorization",
        "Basic " + btoa(client_id + ":" + client_secret)
      );
    },
    dataType: "json",
    data: { grant_type: "client_credentials" },
  }).done(function (response) {
    access_token = response.access_token;
  });

  var spotify = new Spotify();

  $("#artistName").keyup(function () {
    $("#results").empty();
    spotify.getArtist($(this).val());
  });

  $("#bgetArtist").on("click", function () {
    $("#results").empty();
    spotify.getArtist($("#artistName").val());
  });

  $("#results").on("click", ".artistId", function () {
    let id = $(this).data("id");
    $("#results").empty();
    spotify.getArtistById(id);
  });
});

$.fn.addGenres = function (genres) {
  var documentFragment = $(document.createDocumentFragment());
  if (genres.length != 0)
    $(genres).each(function (i, e) {
      if (i < 5)
        $(documentFragment).append($(document.createElement("span")).text(e));
    });
  $(this).append(documentFragment);
};

$.fn.addArtists = function (artists) {
  var documentFragment = $(document.createDocumentFragment());
  if (artists.length != 0)
    $(artists).each(function (i, artist) {
      $(artist).each(function (i, e) {
        $(documentFragment).append(
          $(document.createElement("span")).text(e.name)
        );
      });
    });
  $(this).append(documentFragment);
};

//display artist
function createArtistCard(artist) {
  $(document.createElement("div"))
    .attr({
      class: "container artistId",
    })
    .append(
      $(document.createElement("h3"))
        .attr({
          class: "title",
        })
        .text(artist.name)
    )
    .append(
      $(document.createElement("img")).attr({
        class: "front_img",
        src:
          artist.images.length != 0 ? artist.images[1].url : "./img/pngegg.png",
      })
    )
    .append(
      $(document.createElement("p"))
        .attr({
          class: "followers",
        })
        .text("Followers: " + artist.followers.total)
    )
    .append(
      $(document.createElement("div"))
        .attr({
          class: "genres",
        })
        .append(function () {
          $(this).addGenres(artist.genres);
        })
    )
    .append(
      $(document.createElement("p"))
        .attr({
          class: "followers",
        })
        .text("Popularity: " + artist.popularity + "%")
    )
    .data("id", artist.id)
    .appendTo($("#results"));
  console.log(artist);
}

function createAlbumsCard(album) {
  $(document.createElement("div"))
    .attr({
      class: "container",
    })
    .append(
      $(document.createElement("h3"))
        .attr({
          class: "title",
        })
        .text(album.name)
    )
    .append(
      $(document.createElement("img")).attr({
        class: "front_img",
        src:
          album.images.length != 0 ? album.images[1].url : "./img/pngegg.png",
      })
    )
    .append(
      $(document.createElement("p"))
        .attr({
          class: "followers",
        })
        .text("Tracks: " + album.total_tracks)
    )
    .append(
      $(document.createElement("p"))
        .attr({
          class: "followers",
        })
        .text("Released: " + album.release_date)
    )
    .append(
      $(document.createElement("div"))
        .attr({
          class: "genres",
        })
        .append(function () {
          $(this).addArtists(album.artists);
        })
    )
    .appendTo($("#results"));
}
