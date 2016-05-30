$(document).ready(function(){
	initialize();
});

function initialize()
{
	updateAction();
	formSubmit();
	routesFns();
}

function formSubmit()
{
	submitBtn = $(".send");
	submitBtn.on('click', function(event) {
		event.preventDefault();
		thisBtn = $(this);
		disable(thisBtn);
		form = $(this).closest('form').serializeArray();
		url = $(this).closest('form').attr('action');
		method = $(this).closest('form').attr('method');
		$.ajax({
			url: url,
			type: method,
			data: form,
		})
		.done(function(data) {
			data = JSON.parse(data);
			if(data.erro == 0)
			{
 				window[data.call](data);
			}
			else
			{
				showAlert(data.erro, data.message);
				undisable(thisBtn);
			}
		})
		.fail(function() {
			console.log("error");
			showAlert(1, "Something went wrong. Try Again later.");
			undisable(thisBtn);
		})
		.always(function() {
			console.log("complete");
		});
	});
}

function disable(item)
{
	item.attr('disabled', 'disabled');
	item.addClass('disabled');
	item.text('wait...');
}

function undisable(item)
{
	item.removeAttr('disabled');
	item.removeClass('disabled');
	item.text('submit');
}

function undisable_alt(item, txt)
{
	item.removeAttr('disabled');
	item.removeClass('disabled');
	item.text(txt);
}

function goTo(data)
{
	window.location.href = data.url;
}

function showAlert(erro, message)
{
	type = "danger";
	title = "Oops";
	icon = "icon-sad-face fa-4x";
	if(erro == 0)
	{
		type = "success";
		title = "Success";
		icon = "ti-thumb-up";
	}

	$.notify({
		icon: icon,
		title: title,
		message: message,
		animate: {
			enter: 'animated fadeInUp',
			exit: 'animated fadeOutDown'
		}
	},{
		type: 'minimalist',
		delay: 4000,
		allow_dismiss: true,
		newest_on_top: true,
		template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
			'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
			'<i data-notify="icon" class="bottomspace-sm pull-left"></i>' +
			'<span data-notify="title">{1}</span>' +
			'<span data-notify="message">{2}</span>' +
		'</div>',
		placement: {
			from: "top",
			align: "center"
		}
	});
}

function updateAction()
{
	$(".updaters").click(function(event) {
		/* Act on the event */
		disable($(".updaters"));
		url = $(this).attr('data-url');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json'
		})
		.done(function(data) {
			updateControl(data);
			console.log("success");
		})
		.fail(function() {
			console.log("error");
			undisable($(".updaters"));
			showAlert('danger', 'Something went wrong');
		})
		.always(function() {
			console.log("complete");
		});
		
	});
}

function updateControl(weeks)
{
	total = weeks.length;
	if(total > 0)
	{
		loadStatus(0, total);
		updateWeek(0);
	}
	else
	{
		nothingNew();
	}

	function updateWeek(index)
	{
		val = weeks[index];
		$.ajax({
			url: baseUrl + '/update/week/' + val.from + "/" + val.to,
			dataType: 'json'
		})
		.done(function(data) {
			console.log("success");
			update = index + 1;
			loadStatus(update, total);
			updateWeek(update);
		})
		.fail(function() {
			console.log("error" + index);
			failMsg();
		})
		.always(function() {
			console.log("complete");
		});
	}
}

function loadStatus(actual, total)
{
	divAct = $("#updateaction");
	perc = actual/total*100;
	txt = "<h2>Updating</h2> " +
	"<small class='text-muted'>" + actual + " / " + total + " </small>" +
	"<div class='progress'>"+
		"<div class='progress-bar progress-bar-default' role='progressbar' aria-valuenow='" + perc + "' aria-valuemin='0' aria-valuemax='100' style='width: " + perc + "%'>"+
			"<span class='sr-only'>" + perc + "% of weeks loaded</span>"+
		"</div>"+
	"</div>";
	divAct.html(txt);
	if(actual == total)
	{
		txt = "<h2>Success</h2>" +
		"Now you can enjoy your weekly charts :]";
		undisable_alt($(".new"), "Update new weeks");
		undisable_alt($(".all"), "Update all");
	}
	divAct.html(txt);
}

function nothingNew()
{
	divAct = $("#updateaction");
	txt = "<h2>Your charts are up to date :]</h2> " +
	"<small class='text-muted'>Look like there's nothing to update for now, come back later.</small>";
	divAct.html(txt);
	undisable_alt($(".new"), "Update new weeks");
	undisable_alt($(".all"), "Update all");
}

function failMsg()
{
	divAct = $("#updateaction");
	txt = "<h2>Oops</h2> " +
	"<small class='text-muted'>Something went wrong while saving some of your data. Plesa try update again later. :[</small>";
	divAct.html(txt);
	undisable_alt($(".new"), "Update new weeks");
	undisable_alt($(".all"), "Update all");
}


function routesFns()
{
	switch(curRoute) {
	    case "profile":
	        loadOverall();
	        break;

	    default:
	        break;
	}
}

function loadOverall()
{
	login = curPage.split("/");
	login = login[login.length - 1];
	//loadAct(login, true);
	alb = $(".top-albums");
	rec = $(".recent");
	art = $(".top-artists");
	mus = $(".top-musics");
	$.ajax({
		url: baseUrl + '/load_all/' + login + '/' + 5,
		dataType: 'json'
	})
	.done(function(data) {
		art.html(data.artist);
		alb.html(data.album);
		mus.html(data.music);
		rec.html(data.recent);
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});	
}