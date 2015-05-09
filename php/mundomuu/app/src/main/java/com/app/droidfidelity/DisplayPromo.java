package com.app.droidfidelity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;


public class DisplayPromo extends Activity {

    TextView title;
    ImageView bmImage;
    TextView footerText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_display_promo);

        Intent intent = getIntent();
        String json = intent.getStringExtra(ListMobileActivity.EXTRA_MESSAGE);
        int id = Integer.parseInt(getJsonElement(json, "id") );

        bmImage = (ImageView)findViewById(R.id.logo);
        bmImage.setAdjustViewBounds(true);
        bmImage.setMaxHeight(100);
        bmImage.setMaxWidth(100);
        bmImage.setImageBitmap(MobileArrayAdapter.get(id));

        title=(TextView)findViewById(R.id.title);
        title.setText(getJsonElement(json,"name") );

        TextView textView = (TextView) findViewById(R.id.secondLine);
        textView.setText(getJsonElement(json,"longDesc") );

        footerText = (TextView) findViewById(R.id.footer);
        String footerString = "Direccion: "+getJsonElement(json,"address")+ " - " + "Descuento de "+getJsonElement(json,"discount");
        footerText.setText(footerString );
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_display_promo, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    private String getJsonElement( String json, String value ) {
        String result = null;
        try {
            JSONObject jsonObject = new JSONObject(json);
            result = jsonObject.getString( value);

        } catch (JSONException e) {
            e.printStackTrace();
        }
        return result;
    }
}
