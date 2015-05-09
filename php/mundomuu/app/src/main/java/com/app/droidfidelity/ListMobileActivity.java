package com.app.droidfidelity;

import org.json.JSONArray;
import org.json.JSONException;

import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ListView;
import android.widget.Toast;

public class ListMobileActivity extends ListActivity {

    public final static String EXTRA_MESSAGE = "com.app.MESSAGE";
	ListActivity currentActivity = this;
    public static ProgressDialog dialog;
	public static String[] values = null;
	private final int ID_MENU_EXIT = 1;
	private final int ID_MENU_REFRESH = 2;
 
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		dialog = ProgressDialog.show(currentActivity, "", "Loading. Please wait...", true);
		loadPromotions();
	}

	private void loadPromotions() {
		String[] params =  {Consts.url + "/json/promotionService.php"};
		PromoTaskRetriever promo = new PromoTaskRetriever();
		promo.setCurrentActivity(this);
		promo.execute(params);
	}
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
	    menu.add(Menu.NONE,ID_MENU_EXIT,Menu.NONE,R.string.menu_exit);
	    menu.add(Menu.NONE,ID_MENU_REFRESH,Menu.NONE,R.string.menu_refresh);
		return true;
	}

    @Override
    public boolean onOptionsItemSelected(MenuItem item)
    {
    	//check selected menu item
    	if(item.getItemId() == ID_MENU_EXIT)
    	{
    		this.finish();
    		return true;
    	}
    	
     	if(item.getItemId() == ID_MENU_REFRESH)
    	{
     		loadPromotions();	
    		return true;
    	}
    	
    	return false;
    }

	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {
 
		//get selected items
		String selectedValue = (String) getListAdapter().getItem(position);
		//JSONObject ob = new JSONObject();
        Intent intent = new Intent(currentActivity, DisplayPromo.class);
        intent.putExtra(EXTRA_MESSAGE, selectedValue);
        startActivity(intent);
	}
	
	
	private class PromoTaskRetriever extends AsyncTask<String, byte[], String> {

		public ListActivity parentActivity;
	
		public void setCurrentActivity(ListActivity currentActivity ) {
			parentActivity = currentActivity;
		}
		
		@Override
		protected String doInBackground(String... params) {
			String response = null;
			try {
				response = CustomHttpClient.executeHttpGet(params[0]);
			} catch (Exception e) {
				e.printStackTrace();
			}
			return response.toString();
		}

		@Override
		protected void onPostExecute(String result) {
			super.onPostExecute(result);
			
			try {
				JSONArray jsonArray = new JSONArray(result);
				values = new String[jsonArray.length()];
				
				for( int i=0; i< jsonArray.length(); i++) {
					values[i] = jsonArray.getString(i);
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}
			
			setListAdapter(new MobileArrayAdapter(parentActivity, values));	
		}
		
	}

}