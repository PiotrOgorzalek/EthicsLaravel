var app = new Vue({
	el: '#login',
	data:{
		successMessage: "",
		errorMessage: "",
		logDetails: {email: '', password: ''},
	},

	methods:{
		keymonitor: function(event) {
       		if(event.key == "Enter"){
         		app.checkLogin();
        	}
       	},
		// got quite complicated 
		//first check for data.error if not it checks message returned from php
		checkLogin: function(){
			var logForm = app.toFormData(app.logDetails);
			axios.post('loginStaff.php', logForm)
				.then(function(response){

					if(response.data.error){
						app.errorMessage = response.data.message;
					}
					else
					{
						//check if user is admin
						app.successMessage = response.data.message;
						if (app.successMessage=="Admin Login")
						{
							app.logDetails = {email: '', password:''};
						setTimeout(function(){
							window.location.href="adminPage.php";
						},2000);
						}
						else {
						app.logDetails = {email: '', password:''};
						setTimeout(function(){
							window.location.href="staffPage.php";
						},2000);
					}
					}
				});
		},

		toFormData: function(obj){
			var form_data = new FormData();
			for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function(){
			app.errorMessage = '';
			app.successMessage = '';
		}

	}
});
