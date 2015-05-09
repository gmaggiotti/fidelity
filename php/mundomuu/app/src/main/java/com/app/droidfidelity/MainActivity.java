package com.app.droidfidelity;

import java.util.ArrayList;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends Activity {
    EditText un,pw;
	TextView error;
    Button ok;
    MainActivity currentActivity = this;

    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        /*un=(EditText)findViewById(R.id.et_un);
        pw=(EditText)findViewById(R.id.et_pw);
        ok=(Button)findViewById(R.id.btn_login);*/
        error=(TextView)findViewById(R.id.tv_error);
        doLogin("gabe","123");


    /*    ok.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String username = un.getText().toString();
                String password = pw.getText().toString();
                doLogin(username, password);
            }
        });*/
    }

    private void doLogin(String username, String password) {

        String[] params =  {Consts.url + "/json/loginService.php?json=1&username="+username+
                            "&password="+password
                                ,username
                                ,password};

        try {
            LoginTask loginTask = new LoginTask();
            loginTask.setMyTask( currentActivity );
            loginTask.execute(params);
        } catch (Exception e) {
            error.setText(e.toString());
        }
    }


    private class LoginTask extends AsyncTask<String, byte[], String> {

		public MainActivity parentActivity;

		public void setMyTask(MainActivity a) {
			parentActivity = a;
		}

		@Override
		protected String doInBackground(String... params) {
			ArrayList<NameValuePair> postParameters = new ArrayList<NameValuePair>();
			postParameters.add(new BasicNameValuePair("username", params[1]));
			postParameters.add(new BasicNameValuePair("password", params[2]));

			String response = null;
			try {
				response = CustomHttpClient.executeHttpPost(params[0], postParameters);
			} catch (Exception e) {
				response = "Unable to connect to the server.  Please try again later.";
			}
			return response;
		}

		@Override
		protected void onPostExecute(String result) {
			super.onPostExecute(result);
			if (result.equals("1")) {
				Intent intent = new Intent(this.parentActivity, ListMobileActivity.class);
				startActivity(intent);
                this.parentActivity.finish();
			} else if(result.equals("0"))
				error.setText("Sorry!! Incorrect Username or Password");
			else
				error.setText(result);
		}

	}
	
	
    
}
