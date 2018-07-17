
(function ($) {
  var loadingDefaultValue = '';

  $.fn.loading = function (text = '') {
    text == '' ? text = 'loading...' : text;
    if (text == 'reset') {
      this.removeClass('disabled').attr('disabled', false).html(loadingDefaultValue);
    } else {
      loadingDefaultValue = this[0].innerHTML;
      this.addClass('disabled').attr('disabled', true).html(text);
    }
  };

  $.fn.errorAlert = function (response) {
    var alertStr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    alertStr += '<h4 class="alert-heading"> Status: ' + response.status + '(Ajax error!)</h4>';
    alertStr += '<strong>URL:</strong> ' + response.url;
    alertStr += '<hr>';
    alertStr += '<p class="mb-0"><strong>TEXT:</strong> ' + response.statusText + '</p>';
    alertStr += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    alertStr += '<span aria-hidden="true">&times;</span>';
    alertStr += '</button>';
    alertStr += '</div >';

    this.prepend(alertStr);

    setTimeout(function () {
      $('.alert-danger').remove();
    }, 3000);
  };

  jQuery.extend({
    "setCookie": function(key, value, minutes = 60) {
      var d = new Date();
      d.setTime(d.getTime() + (minutes * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      
      document.cookie = key + "=" + value + "; " + expires;
    },
    "getCookie": function(key) {
      var name = key + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
      }

      return "";
    },
    "clearCookie": function(key) {
      this.setCookie(key, "", -1);
    }
  });
})(jQuery);
