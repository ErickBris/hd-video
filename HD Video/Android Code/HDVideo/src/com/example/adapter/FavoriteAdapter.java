package com.example.adapter;

import java.util.List;

import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.favorite.Pojo;
import com.example.imageloader.ImageLoader;
import com.example.util.Constant;
import com.viaviapp.hdvideo.R;

public class FavoriteAdapter extends BaseAdapter {
	
	
	LayoutInflater inflate;
	Activity activity;
	private List<Pojo> data;
	public ImageLoader imageLoader; 

	public FavoriteAdapter(List<Pojo> contactList, Activity activity, int columnWidth)
	{
		this.activity=activity;
		this.data=contactList;
		inflate = (LayoutInflater)activity.getSystemService(Activity.LAYOUT_INFLATER_SERVICE);
		imageLoader=new ImageLoader(activity);
		
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return data.size();
	}

	@Override
	public Object getItem(int arg0) {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public long getItemId(int position) {
		// TODO Auto-generated method stub
		return position;
	}
	
	class GroupItem
	{
		public ImageView imgv_latetst;
		public  TextView name,txt_time,txt_category;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		// TODO Auto-generated method stub
		
		View vi=null;
		final  GroupItem holder =new GroupItem();
		vi=inflate.inflate(R.layout.latest_lsv_item, null);
		 holder.imgv_latetst=(ImageView)vi.findViewById(R.id.picture);
		 holder.name=(TextView)vi.findViewById(R.id.text);
		 holder.txt_time=(TextView)vi.findViewById(R.id.second);
		 holder.txt_category=(TextView)vi.findViewById(R.id.text_category);

		
		 if(data.get(position).getVideoId().equals("000q1w2"))
		 {
			 imageLoader.DisplayImage(Constant.SERVER_IMAGE_UPFOLDER+data.get(position).getImageUrl().toString(), holder.imgv_latetst);
		 }
		 else
		 {
			 imageLoader.DisplayImage(Constant.YOUTUBE_IMAGE_FRONT+data.get(position).getVideoId().toString()+Constant.YOUTUBE_SMALL_IMAGE_BACK, holder.imgv_latetst);
		 }
		
		

		 holder.name.setText(data.get(position).getVideoName().toString());
		 holder.txt_time.setText(data.get(position).getDuration().toString());
		 holder.txt_category.setText(data.get(position).getCategoryName().toString());
		
		return vi;
	}

}

