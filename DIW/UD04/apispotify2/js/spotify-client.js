var client_id = "54daf2691cee41aab558f29651b04649";
var client_secret = "d21bd57ab1aa4529aae14522c474bad1";
var access_token = "";

//We create the Spotify class with the API to make the call to
function Spotify() {
  this.apiUrl = "https://api.spotify.com/";
}

function getGenres(genres) {
  if (genres.length == 0) return "";
  //use array
  let arrayGenres = [];

  $(genres).each(function (i, e) {
    arrayGenres.push($(document.createElement("span").text(e)));
  });
  console.log(arrayGenres);
}

//display artists
function createArtistCard(artist) {
  $(document.createElement("div"))
    .attr({
      class: "container",
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
      $(document.createElement("p")).attr({
        class: "genres",
      })
      /*         .append(getGenres(artist.genres))
       */
    )
    .appendTo($("#results"));
  console.log(getGenres(artist.genres));
  console.log(artist);
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
    $("#num_results_artists").find("span").text(response.artists.total);
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

  $("#bgetArtist").on("click", function () {
    $(".container").remove();
    spotify.getArtist($("#artistName").val());
  });

  $("#results").on("click", ".artistId", function () {
    spotify.getArtistById($(this).attr("data-id"));
  });
});
