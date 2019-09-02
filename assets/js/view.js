var app = angular.module('viewApp', []);
app.filter('activelinks', function(){
	var category = location.search.replace("?cat=","");
	var cut = /%20/gi;
	category = category.replace(cut," ");
	return function(cat){
		if(cat == category)
			return "active";
	}
})
app.filter('submitted', function(){
	return function(score){
		if(score.length > 0)
			return "display:block;";
	}
})
app.filter('hasCriteria', function(){
	return function(crit){
		if(crit != "")
			return "col-md-6";
		else
			return "";
	}
})
app.filter('hasScore', function(){
	return function(score){
		if(score == undefined )
			return;
		else
			return score.crit + " (" + score.score + ")"
	}
})
app.filter('include', function(){
	return function(e){
		var category = location.search.replace("?cat=","");
		var cut = /%20/gi;
		category = category.replace(cut," ");

		if(category == "Final Q and A"){
			if(e.length > 0)
				return	"display:block;";
			else
				return "display:none;";
		}
	}
})
app.controller('viewCtrl' ,function($scope , $http){
	var category = location.search.replace("?cat=","");
	var events = "";
	var cut = /%20/gi;
	category = category.replace(cut," ");
	var score = [];
	var token = (JSON.parse(localStorage.getItem("token")).user)
	var max_score = 0;
	var hideNavi = 0;
	var totalCandi = 0;
	var ref = 0;
	$scope.token = token;

	var overlayref = 0;

	$http({
		url: "api/judging.php",
		method: "GET",
		params: {
			cat: category,
			judge: token.name
		}
	}).then(function(response){
		
		// console.log(response.data);
		$scope.categories = response.data.category;
		$scope.criteria = response.data.criteria; 
		$scope.candidates = response.data.candidate;
		events = response.data.scoring.events;
		max_score = response.data.scoring.max_score;

		totalCandi = response.data.candidate.length;
		

		for (var i = 0; i < totalCandi; i++) {
			if(response.data.candidate[i][1].length > 0){hideNavi++;}
		}
		ref = hideNavi;
		for (var i = 0; i < 10; i++) {score.push(i);}

		$scope.scoring = score;

	});

	$scope.logout = function(){
		$http({
			url : "api/logout.php",
			method: "GET",
			params: {
				user: token.username
			}
		}).then(function(response){
			if(response.data.updated){
				localStorage.setItem("token", "");
				location.href = "/";
			}
		})
	}
	$scope.score1 = 0;
	$scope.getScore = function(e, id, option,crit){
		var tmp = $("#can" + id).find(".scoredata" + crit).val();
		var tmp1 = tmp + e.score;
		var tmp2 = parseFloat(tmp + option);

		if(tmp1 > Number(max_score)){ 
			swal("Score must not exceed " + max_score );
			$("#can" + id).find(".scoredata" + crit).val(0)
			 return;
		}
		if (tmp.length > 4) { return;}
		var score = Number(tmp1).toPrecision(4)
		if(	option != "."){
			if(tmp == "0"){ $("#can" + id).find(".scoredata" + crit).val(e.score); }
			else{ $("#can" + id).find(".scoredata" + crit).val(tmp1); }
		}else{
			if(tmp == "0"){ $("#can" + id).find(".scoredata" + crit).val(tmp + option); }
			else{ $("#can" + id).find(".scoredata" + crit).val(tmp + option); }
		}
		
	}

	$scope.clear = function(id,crit){
		$("#can" + id).find(".scoredata" + crit).val("0");
	}

	$scope.submit = function(e, crit){
		if(hideNavi == ref){
			$("section .navbar .container .collapse .nav").slideUp();
		}
		hideNavi++;
		if(category != "Prelim Q and A"){
			if(hideNavi == totalCandi){
				$("section .navbar .container .collapse .nav").slideDown();
				$("#content .nextcat").show();
				hideNavi = 0;
			}
		}
		if(category == "Prelim Q and A"){
			if(hideNavi == (totalCandi * 2)){
				$("section .navbar .container .collapse .nav").slideDown();
				$("#content .nextcat").show();
				hideNavi = 0;
			}
		}

		
		var indivScore = $("#can" + e.candidate[0].record).find(".scoredata" + crit).val();

		if(indivScore == "0"){
			swal({
				title: 'Are you sure you want to submit?',
				text: "Once submitted, score will not be changed",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Confirm!'
		  }).then((result1) => {
			if (result1.value) {
				$http({
					url: "api/score.php",
					method: "GET",
					params: {
						judge: token.name,
						events: events,
						category: category,
						candidate: e.candidate[0].name,
						region: e.candidate[0].team,
						score: indivScore,
						crit : crit
					}
				}).then(function(response){
					if(response.data.created){
						if(crit == ""){
							$("#can" + e.candidate[0].record).find(".overlay").show(100);
							$("#can" + e.candidate[0].record).animate({height: "250px"});
						}else{
							$("#can" + e.candidate[0].record).find(".form" + crit).show(100);
							overlayref++;
							if(overlayref == 2){
								$("#can" + e.candidate[0].record).find(".overlay").show(100);
								$("#can" + e.candidate[0].record).animate({height: "250px"});
								overlayref = 0;
							}
						}
						
					}
					else{
						if(crit == ""){
							$("#can" + e.candidate[0].record).find(".overlay").show(100);
							$("#can" + e.candidate[0].record).animate({height: "250px"});
						}else{
							$("#can" + e.candidate[0].record).find(".form" + crit).show(100);
							overlayref++;
							if(overlayref == 2){
								$("#can" + e.candidate[0].record).find(".overlay").show(100);
								$("#can" + e.candidate[0].record).animate({height: "250px"});
								overlayref = 0;
							}
						}
					}
				});
			}
		  })
		}
		else{
			$http({
				url: "api/score.php",
				method: "GET",
				params: {
					judge: token.name,
					events: events,
					category: category,
					candidate: e.candidate[0].name,
					region: e.candidate[0].team,
					score: indivScore,
					crit : crit
				}
			}).then(function(response){
				if(response.data.created){
					if(crit == ""){
						$("#can" + e.candidate[0].record).find(".overlay").show(100);
						$("#can" + e.candidate[0].record).animate({height: "250px"});
					}else{
						$("#can" + e.candidate[0].record).find(".form" + crit).show(100);
						overlayref++;
						if(overlayref == 2){
							$("#can" + e.candidate[0].record).find(".overlay").show(100);
							$("#can" + e.candidate[0].record).animate({height: "250px"});
							overlayref = 0;
						}
					}
					
				}
			});
		}
		
	}
	$scope.next =function(){
		$("#cat-link .active").next().find("a").click();
	}

});
