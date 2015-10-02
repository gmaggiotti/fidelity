package com.app.alacarta;

import java.io.InputStream;

import org.json.JSONException;
import org.json.JSONObject;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.util.Log;
import android.util.SparseArray;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class MobileArrayAdapter extends ArrayAdapter<String> {
	private final Context context;
	private static String[] values;
	private static SparseArray<Bitmap> bitmap = new SparseArray<Bitmap>();

	public MobileArrayAdapter(Context context, String[] values) {
		super(context, R.layout.list_mobile, values);
		this.context = context;
		this.values = values;
		loadBitmapSArray();
		ListMobileActivity.dialog.dismiss();
	}
 
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		LayoutInflater inflater = (LayoutInflater) context
			.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
 
		View rowView = inflater.inflate(R.layout.list_mobile, parent, false);
		
		TextView title = (TextView) rowView.findViewById(R.id.title);
		title.setText(getJsonElement(position,"name") );
		
		TextView textView = (TextView) rowView.findViewById(R.id.secondLine);
		textView.setText(getJsonElement(position,"shortDesc") );
		
		TextView footerText = (TextView) rowView.findViewById(R.id.footer);
        String discount = getJsonElement(position,"discount");
        if( !(discount.equals("")||discount.equals("0")) )
            discount = " - "+ "Descuento de "+discount ;
		String footerString = "Direccion: "+getJsonElement(position,"address") + discount;
		footerText.setText(footerString );

        int id = Integer.parseInt(getJsonElement(position, "id") );
		ImageView bmImage = (ImageView) rowView.findViewById(R.id.logo);
		bmImage.setAdjustViewBounds(true);
		bmImage.setMaxHeight(100);
		bmImage.setMaxWidth(100);
		bmImage.setImageBitmap(bitmap.get(id));
		
		return rowView;
	}

    public static Bitmap get( int key ) {
       return bitmap.get(key);
    }

	private class LogosList implements Runnable {

		private int i;

		public  LogosList( int i) {
			this.i = i;
		}

		public void run() {
			String imgName = getJsonElement(i, "logo_img");
			Bitmap bm = loadBitmap(Consts.url + "/imgs/" + imgName);
            int id = Integer.parseInt(getJsonElement(i, "id") );
            bitmap.put(id, bm);
		}

		private Bitmap loadBitmap(String urldisplay) {
			Bitmap mIcon11 = null;
			try {
				InputStream in = new java.net.URL(urldisplay).openStream();
				mIcon11 = BitmapFactory.decodeStream(in);
			} catch (Exception e) {
				Log.e("Error", e.getMessage());
				e.printStackTrace();
			}
			return mIcon11;
		}
	}

	private void loadBitmapSArray() {
		int len = values.length;
		Thread[] threads = new Thread[len];
		for (int i = 0; i < len; i++) {
			threads[i] = new Thread(new LogosList(i));
			threads[i].start();
		}

		for (int i = 0; i < len; i++) {
			try {
				threads[i].join();
			} catch (InterruptedException e) {
			}
		}
	}

	
	private String getJsonElement( int position, String value ) {
		String result = null;
		try {
			JSONObject jsonObject = new JSONObject(values[position]);
			result = jsonObject.getString( value);
			
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return result;
	}

    void sleep(int i) {
        try {
            Thread.sleep(i);
        } catch (InterruptedException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
    }
}
