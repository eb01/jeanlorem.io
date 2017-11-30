'use strict';

//** Global vars **\\

// Arrays who will returns jokes content
var jokesAllHeaders = [];
var jokesAllParagraphs = [];
var jokesSafeHeaders = [];
var jokesSafeParagraphs = [];

// Vars who will returns length -1 for set the correct maxNum param of getRandomNumber()
var jokesAllHeadersLength;
var jokesAllParagraphsLength;
var jokesSafeHeadersLength;
var jokesSafeParagraphsLength;


//** Functions **\\

// return the jokes.json file
function getJokes() {
    return $.getJSON('jokes.json');
};

// return a random number
function getRandomNumber(maxNum) {
    var minNum = 0;
    var diff = maxNum - minNum + 1;
    return Math.floor(Math.random() * diff + minNum);
};

// replace html tags
function escapeHtml(unsafe) {
    return unsafe
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
 };

// build the dynamic textarea with form values and random number
function buildRandomJeanLorem() {
    var builder = '';
    var paragraphInput = $('#paragraph').val();
    for(var i = 0; i < paragraphInput; i++) {
        if ($('#header-with-tag').val() != "Non") {
            builder += "<" + $('#header-with-tag').val() + ">";
            if($('#audience').prop('checked')) {
                builder += escapeHtml(jokesAllHeaders[getRandomNumber(jokesAllHeadersLength)]);
            } else {
                builder += escapeHtml(jokesSafeHeaders[getRandomNumber(jokesSafeHeadersLength)]);
            }
            builder += "</" + $('#header-with-tag').val() + ">\n";
        };
        if($('#paragraph-tag').prop('checked')) {
            builder += "<p>";
        };
        if($('#audience').prop('checked')) {
            builder += escapeHtml(jokesAllParagraphs[getRandomNumber(jokesAllParagraphsLength)]);
        } else {
            builder += escapeHtml(jokesSafeParagraphs[getRandomNumber(jokesSafeParagraphsLength)]);
        }
        if($('#paragraph-tag').prop('checked')) {
            builder += "</p>";
        };
        builder += "\n\n";
    };
    var build = "<!-- start jeanLorem code -->\n\n" + builder + "<!-- end jeanLorem code -->";
    $('textarea').val(build);
};


//** Code execution **\\

$(document).ready(function() {

// When jokes.json return is done
getJokes().done(function(data) {
    // Loop in json data on key=>value and add each joke_content to the appropriate jokes array
    $.each(data, function(key, value) {
        if(value.joke_tagType === 'header') {
            jokesAllHeaders.push(value.joke_content);
        };
        if(value.joke_tagType === 'paragraph') {
            jokesAllParagraphs.push(value.joke_content);
        };
        if(value.joke_audience === 'all' && value.joke_tagType === 'header') {
            jokesSafeHeaders.push(value.joke_content);
        };
        if(value.joke_audience === 'all' && value.joke_tagType === 'paragraph') {
            jokesSafeParagraphs.push(value.joke_content);
        };
    });
    // Prepare corrects arrays length for getRandomNumber()
    jokesAllHeadersLength       =   jokesAllHeaders.length - 1;
    jokesAllParagraphsLength    =   jokesAllParagraphs.length -1;
    jokesSafeHeadersLength      =   jokesSafeHeaders.length -1;
    jokesSafeParagraphsLength   =   jokesSafeParagraphs.length -1;
});

// When user is on focus inside the jokes zone, all the text is selected
$('#jokes-zone').focus(function() {
    $(this).select();
});

//*** jQuery Plugins ***\\\

//--- jQuery Validation Plugin -- Settings ---\\

/*This is my first use of this plugin. With it, I have tried to enhance the
 *user experience before validation and to do some JS treatments
 *(before doing the PHP treatments)
*/  

$("#generate-form").submit(function(e) {
    // prevent the default submit comportment
    e.preventDefault();
}).validate({
    rules: {
        paragraph: {
        required: true,
        range: [1,99]
        }
    },
    submitHandler: function(form) {
        // exec is here 
        buildRandomJeanLorem();
        return false;
    },
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
});

$('#login-form').validate({
    rules: {
        username: {
            required: true
            },
        password: {
            required: true
            }
    },
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        };
    }
});

$('.add-edit-form').validate({
    rules: {
        "joke-content": {
            required: true,
            rangelength: function(element) {
                if($("#joke-tagtype").val() === "header") {
                    return [8, 100];
                } else if($("#joke-tagtype").val() === "paragraph") {
                    return [101, 700];
                }
            }
        }
    },
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
});

// Custom messages
$.extend($.validator.messages, {
    required: "Champ requis",
    email: "Email requis",
    number: "Entrez une valeur numérique SVP",
    accept: "C'est OK !",
    maxlength: $.validator.format("Merci de saisir au maximum {0} caractères."),
    minlength: $.validator.format("Merci de saisir au minimum {0} caractères."),
    rangelength: $.validator.format("Merci de saisir entre {0} et {1} caractéres."),
    range: $.validator.format("Merci de saisir un nombre entre {0} et {1}."),
    max: $.validator.format("Merci de saisir un nombre inférieur ou égal à {0}."),
    min: $.validator.format("Merci de saisir un nombre supérieur ou égal à {0}.")
});
//--- end of jQuery Validation Plugin -- Settings ---\\


//--- Character Counter plugin -- Settings ---\\
// Set remaining characters counter, depends on joke tag type
if ($("#joke-tagtype").val() === "header") {
    $( ".counter" ).remove();
    $("#joke-content").characterCounter({
        limit: '100',
        counterFormat: '%1 caractères restants'
    });
} else if ($("#joke-tagtype").val() === "paragraph") {
    $( ".counter" ).remove();
    $("#joke-content").characterCounter({ 
        limit: '700',
        counterFormat: '%1 caractères restants' 
    });  
};

// Set remaining characters counter, depends on joke tag type on user select changes
$("#joke-tagtype").change(function() {
    if ($("#joke-tagtype").val() === "header") {
        $( ".counter" ).remove();
        $("#joke-content").characterCounter({ 
            limit: '100',
            counterFormat: '%1 caractères restants'
        });
    } else if ($("#joke-tagtype").val() === "paragraph") {
        $( ".counter" ).remove();
        $("#joke-content").characterCounter({ 
            limit: '700',
            counterFormat: '%1 caractères restants'
        });  
    };
});
//--- end of Character Counter plugin -- Settings ---\\


//--- jsSocials plugin -- Settings ---\\
$("#share-bar").jsSocials({
    showCount: true,
    showLabel: true,
    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "whatsapp"]
});
//--- end of jsSocials plugin -- Settings ---\\

//--- Bootstrap Confirmation Plugin -- Settings ---\\
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  singleton: true,
  popout: true,
  title: 'Es-tu sûr de vouloir supprimer cette blague/citation ?',
  btnOkLabel: 'Oui',
  btnOkIcon: 'fa fa-check',
  btnOkClass: 'btn-sm btn-success',
  btnCancelLabel: 'Non',
  btnCancelIcon: 'fa fa-times',
  btnCancelClass: 'btn-sm btn-danger'
});
//--- end of Bootstrap Confirmation Plugin -- Settings ---\\

});