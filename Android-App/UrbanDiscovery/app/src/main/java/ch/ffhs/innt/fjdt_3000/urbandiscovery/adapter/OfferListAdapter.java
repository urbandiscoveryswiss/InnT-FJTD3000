/*
 * Copyright (C) 2016 Projekt-Hockey (PA_5.BSc INF/WI 2014.BE/ZH.HS16/17)
 *
 * Nicolas Hirs, Thomas Schwander, Remo Niklaus
 */

package ch.ffhs.innt.fjdt_3000.urbandiscovery.adapter;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.URLUtil;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;


import java.io.File;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.R;
import io.swagger.client.model.Offer;

/**
 * Klasse um neusten Beitraege der Website uebersichtlich in einer Liste Anzuzeigen
 *
 * @see BaseAdapter
 */
public class OfferListAdapter extends BaseAdapter {
    private static final String TAG = OfferListAdapter.class.getSimpleName();
    private List<Offer> offerList;
    private LayoutInflater inflater;
    private Context context;

    private String[] colors = {"#eb7d3c","#4673c1","#72ac4d"};
    /**
     * Konstruktor
     *
     * @param offerList
     */
    public OfferListAdapter(Context context, List<Offer> offerList){
        this.context = context;
        inflater = LayoutInflater.from(this.context);
        this.offerList = offerList;
    }

    @Override
    public int getCount() {
        return offerList.size();
    }

    @Override
    public Object getItem(int position) {
        return offerList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }


    /**
     * @return View bestehend aus einem Vorschaubild und dem Beitragstitel
     */
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        ViewHolder holder;

        if(convertView == null){
            convertView = inflater.inflate(R.layout.adapter_offer_list,parent, false);

            holder = new ViewHolder();
            holder.linearLayout = (LinearLayout) convertView.findViewById(R.id.offer_layout);
            holder.title = (TextView) convertView.findViewById(R.id.offer_title);
            holder.descripion = (TextView) convertView.findViewById(R.id.offer_description);
            convertView.setTag(holder);
        } else {
            // Holder bereits vorhanden
            holder = (ViewHolder) convertView.getTag();
        }

        Context context = parent.getContext();
        Offer offer = (Offer) getItem(position);

        holder.title.setText(offer.getTitle());
        holder.title.setTag(offer.getId());
        holder.descripion.setText(offer.getDescription());

        int rnd = new Random().nextInt(colors.length);
        holder.linearLayout.setBackgroundColor(Color.parseColor(colors[rnd]));
        holder.linearLayout.setTag(colors[rnd]);
        return convertView;
    }

    /**
     * Methode um die Ansicht zu aktualisieren
     * nachdem die neuesten Daten vom Server geladen wurden.
     */
    public void updateList(List<Offer> websiteFeedList2) {
        offerList = websiteFeedList2;
        notifyDataSetChanged();
    }

    static class ViewHolder {
        TextView title;
        TextView descripion;
        LinearLayout linearLayout;
    }
}
