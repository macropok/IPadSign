$(document).ready(function () {

	var baseURL = "http://localhost/IPadSign/backend";
	//var baseURL = "http://www.cosainvestments.com/IPadSign/backend";


    $(function(){

        var defaultOption = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
        };
		
		var option1 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output1'
        };
		var option2 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output2'
        };
		
		
		var option3 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output_buyer_1'
        };
		
		var option4 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output_buyer_2'
        };
		
		var option5 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output_seller_1'
        };
		
		var option6 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output_seller_2'
        };
		
		var option7 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output_broker_1'
        };
		
		var option8 = {
            bgColour : '#fff'
            , drawOnly : true
            , penWidth : 4
            ,lineTop : 150
			,output: '.output_broker_2'
        };
		
		
		
		
        $('#by_sigPad1').signaturePad(option1);
		$('#by_sigPad2').signaturePad(option2);
		
		
        $('.sc_sigPad').signaturePad(defaultOption);
		
        $('#se_sigPad1').signaturePad(option1);
		$('#se_sigPad2').signaturePad(option2);
		
		
        $('.cl_sigPad').signaturePad(defaultOption);
		
		$('#lb_buyerSig1').signaturePad(option3);
		$('#lb_sellerSig1').signaturePad(option5);
		
		$('#lb_buyerSig2').signaturePad(option4);
		$('#lb_sellerSig2').signaturePad(option6);
		
		$('#lb_brokerSig1').signaturePad(option7);
		$('#lb_brokerSig2').signaturePad(option8);
		
		
		$('#lb_brokerSig1').signaturePad(option7);
		$('#lb_brokerSig2').signaturePad(option8);
		
		$('#pa_seller_sign1').signaturePad(option5);
		$('#pa_seller_sign2').signaturePad(option6);
		$('#pa_buyer_sign').signaturePad(option3);
		
    });


    $('#by_submit').on('click',function (){


        var form = $("#by_form");

        $("#by_submit").attr("disabled","disabled");

        var formValues = form.serializeArray().map(function(v){
            var a = {};

            //eval('a[\''+ v.name + '\'] = \'' + v.value+'\'');
            eval('a.'+ v.name + '=\''+ v.value+'\'');
            return a;
        });


        var params = JSON.stringify(formValues);
        if(true)
        {
            $.ajax({
                url: baseURL + "/generate_pdf.php",
                type: "POST",
                crossDomain: true,
                beforeSend : function() {$.mobile.loading('show');},
                complete   : function() {$.mobile.loading('hide');},

                data: {
                    'formType':'buyer',
                    'params':params
                },
                success: function( response )
                {
                    alert(response);
                },
                error: function(err){
                    alert('error');
                }
            });


        } else {
            //app.showAlert("You must enter a username, password and website", function() {});
            $("#by_submit").removeAttr("disabled");
        }
        return false;

    });




    $('#se_submit').on('click',function (){


        var form = $("#se_form");

        $("#se_submit").attr("disabled","disabled");

        var formValues = form.serializeArray().map(function(v){
            var a = {};

            //eval('a[\''+ v.name + '\'] = \'' + v.value+'\'');
            eval('a.'+ v.name + '=\''+ v.value+'\'');
            return a;
        });


        var params = JSON.stringify(formValues);
        if(true)
        {
            $.ajax({
                url: baseURL + "/generate_pdf.php",
                type: "POST",
                crossDomain: true,
                beforeSend : function() {$.mobile.loading('show');},
                complete   : function() {$.mobile.loading('hide');},

                data: {
                    'formType':'seller',
                    'params':params
                },
                success: function( response )
                {
                    alert(response);
                },
                error: function(err){
                    alert('error');
                }
            });


        } else {
            //app.showAlert("You must enter a username, password and website", function() {});
            $("#se_submit").removeAttr("disabled");
        }
        return false;

    });

    $('#sc_submit').on('click',function (){


        var form = $("#sc_form");

        $("#sc_submit").attr("disabled","disabled");

        var formValues = form.serializeArray().map(function(v){
            var a = {};

            //eval('a[\''+ v.name + '\'] = \'' + v.value+'\'');
            eval('a.'+ v.name + '=\''+ v.value+'\'');
            return a;
        });


        var params = JSON.stringify(formValues);
        if(true)
        {
            $.ajax({
                url: baseURL + "/generate_pdf.php",
                type: "POST",
                crossDomain: true,
                beforeSend : function() {$.mobile.loading('show');},
                complete   : function() {$.mobile.loading('hide');},

                data: {
                    'formType':'showingcondition',
                    'params':params
                },
                success: function( response )
                {
                    alert(response);
                },
                error: function(err){
                    alert('error');
                }
            });


        } else {
            //app.showAlert("You must enter a username, password and website", function() {});
            $("#sc_submit").removeAttr("disabled");
        }
        return false;
    });

    $('#cl_submit').on('click',function (){
        var form = $("#cl_form");
        $("#cl_submit").attr("disabled","disabled");

        var formValues = form.serializeArray().map(function(v){
            var a = {};

            //eval('a[\''+ v.name + '\'] = \'' + v.value+'\'');
            eval('a.'+ v.name + '=\''+ v.value+'\'');
            return a;
        });


        var params = JSON.stringify(formValues);
        if(true)
        {
            $.ajax({
                url: baseURL + "/generate_pdf.php",
                type: "POST",
                crossDomain: true,
                beforeSend : function() {$.mobile.loading('show');},
                complete   : function() {$.mobile.loading('hide');},

                data: {
                    'formType':'checklist',
                    'params':params
                },
                success: function( response )
                {
                    alert(response);
                },
                error: function(err){
                    alert('error');
                }
            });


        } else {
            //app.showAlert("You must enter a username, password and website", function() {});
            $("#cl_submit").removeAttr("disabled");
        }
        return false;

    });
	
	
	
    $('#lb_submit').on('click',function (){


        var form = $("#lb_form");

        $("#lb_submit").attr("disabled","disabled");

        var formValues = form.serializeArray().map(function(v){
            var a = {};

            //eval('a[\''+ v.name + '\'] = \'' + v.value+'\'');
            eval('a.'+ v.name + '=\''+ v.value+'\'');
            return a;
        });


        var params = JSON.stringify(formValues);
        if(true)
        {
            $.ajax({
                url: baseURL + "/generate_pdf.php",
                type: "POST",
                crossDomain: true,
                beforeSend : function() {$.mobile.loading('show');},
                complete   : function() {$.mobile.loading('hide');},

                data: {
                    'formType':'leadbased',
                    'params':params
                },
                success: function( response )
                {
                    alert(response);
                },
                error: function(err){
                    alert('error');
                }
            });


        } else {
            //app.showAlert("You must enter a username, password and website", function() {});
            $("#lb_submit").removeAttr("disabled");
        }
        return false;

    });
	
	
	
	$('#pa_submit').on('click',function (){


        var form = $("#pa_form");

        $("#pa_submit").attr("disabled","disabled");

        var formValues = form.serializeArray().map(function(v){
            var a = {};

            //eval('a[\''+ v.name + '\'] = \'' + v.value+'\'');
            eval('a.'+ v.name + '=\''+ v.value+'\'');
            return a;
        });


        var params = JSON.stringify(formValues);
        if(true)
        {
            $.ajax({
                url: baseURL + "/generate_pdf.php",
                type: "POST",
                crossDomain: true,
                beforeSend : function() {$.mobile.loading('show');},
                complete   : function() {$.mobile.loading('hide');},

                data: {
                    'formType':'purchase',
                    'params':params
                },
                success: function( response )
                {
                    alert(response);
                },
                error: function(err){
                    alert('error');
                }
            });


        } else {
            //app.showAlert("You must enter a username, password and website", function() {});
            $("#pa_submit").removeAttr("disabled");
        }
        return false;

    });




});