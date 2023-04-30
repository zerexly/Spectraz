package com.coderealm.spectraz.activitesfragments.argear.adapter;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import androidx.recyclerview.widget.RecyclerView;

import com.facebook.drawee.view.SimpleDraweeView;
import com.coderealm.spectraz.activitesfragments.argear.model.ItemModel;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.simpleclasses.Functions;

import java.util.ArrayList;
import java.util.List;


public class FilterListAdapter extends RecyclerView.Adapter<FilterListAdapter.ViewHolder> {

	private List<ItemModel> mItems = new ArrayList<>();

	public interface Listener{
		void onFilterSelected(int position, ItemModel item);
	}

	private Listener mListener;


	public FilterListAdapter( Listener listener) {
		mListener = listener;
	}

	public void setData(List<ItemModel> items){
		mItems.clear();
		if(items != null) {
			mItems.addAll(items);
		}
		notifyDataSetChanged();
	}

	@Override
	public int getItemCount() {
		return mItems.size();
	}

	@Override
	public void onBindViewHolder(final ViewHolder holder, final int position) {
		holder.bind(position);
	}

	@Override
	public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
		View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_filter, parent, false);
		return new ItemViewHolder(v);
	}

	@Override
	public int getItemViewType(int position) {
		return 0;
	}

	abstract class ViewHolder extends RecyclerView.ViewHolder {
		abstract void bind(int position);

		ViewHolder(View v) {
			super(v);
		}
	}

	public class ItemViewHolder extends ViewHolder implements View.OnClickListener {
		SimpleDraweeView mImageViewItemThumbnail = null;
		TextView mTextViewTitle = null;

		ItemModel mItem;

		int position;

		ItemViewHolder(View v) {
			super(v);
			mImageViewItemThumbnail =  v.findViewById(R.id.item_thumbnail_imageview);
			mTextViewTitle = (TextView) v.findViewById(R.id.title_textview);
		}

		@Override
		void bind(int position) {
			mItem = mItems.get(position);
			this.position = position;

			mImageViewItemThumbnail.setOnClickListener(this);
			mImageViewItemThumbnail.setController(Functions.frescoImageLoad(mItem.thumbnailUrl,R.drawable.image_placeholder,mImageViewItemThumbnail,false));
			mTextViewTitle.setText(mItem.title);
		}

		@Override
		public void onClick(View v) {
			if (mListener != null) {
				mListener.onFilterSelected(position, mItem);
			}
		}
	}
}