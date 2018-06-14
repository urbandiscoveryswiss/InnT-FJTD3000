/*
 * Copyright (C) 2016 Projekt-Hockey (PA_5.BSc INF/WI 2014.BE/ZH.HS16/17)
 *
 * Nicolas Hirs, Thomas Schwander, Remo Niklaus
 */

package ch.ffhs.innt.fjdt_3000.urbandiscovery.db;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteQueryBuilder;
import android.util.Log;

import java.util.ArrayList;
import java.util.List;

import io.swagger.client.model.Offer;


public class OfferSpeicher {

    private static final String TAG = "OfferSpeicher";

    private UDDatabase udDatabase;

    public OfferSpeicher(Context context){
        udDatabase = UDDatabase.getInstance(context);
        openDB();
    }

    @SuppressWarnings("unused")
    public OfferSpeicher(){
    }

    public Offer loadOffer(long id) {
        Offer offer = null;
        Cursor c = null;
        try {
            c = udDatabase.getReadableDatabase().query(
                    OfferTbl.TABLE_NAME,
                    OfferTbl.ALL_COLUMNS,
                    OfferTbl.WHERE_ID_EQUALS, new String[] {String.valueOf(id)}, null, null, null);
            if (c.moveToFirst() == false) {
                return null;
            }
            offer = loadOffer(c);
        } finally {
            if (c != null) {
                c.close();
            }
        }
        return offer;
    }

    public Offer loadOffer(Cursor c) {
        final Offer offer = new Offer();
        offer.setId(c.getLong(c.getColumnIndex(OfferTbl.UID)));
        offer.setUserid(c.getLong(c.getColumnIndex(OfferTbl.USERID)));
        offer.setTitle(c.getString(c.getColumnIndex(OfferTbl.TITLE)));
        offer.setDescription(c.getString(c.getColumnIndex(OfferTbl.DESCRIPTION)));
        offer.setCondition(c.getString(c.getColumnIndex(OfferTbl.CONDITION)));
        offer.setStart(c.getString(c.getColumnIndex(OfferTbl.START)));
        offer.setEnd(c.getString(c.getColumnIndex(OfferTbl.END)));
        return offer;

    }

    public Cursor loadOfferList(){
        final SQLiteQueryBuilder offerSearch =  new SQLiteQueryBuilder();
        offerSearch.setTables(OfferTbl.TABLE_NAME);

        return offerSearch.query(udDatabase.getReadableDatabase(),
                OfferTbl.ALL_COLUMNS,
                null,
                null,
                null,
                null,
                OfferTbl.DEFAULT_SORT_ORDER);
    }



    public List<Offer> getOfferList(){
        List<Offer> offerList = new ArrayList<Offer>();
        Cursor cur = loadOfferList();
        if (cur.moveToFirst()){
            do{
                Offer offer = loadOffer(cur);
                offerList.add(offer);
            }while(cur.moveToNext());
        }
        return offerList;
    }

    public long saveOrUpdateOffer(Offer offer){
        if(findIDbyUID(offer.getId()) == 0){
            return saveOffer(offer.getId(),
                    offer.getUserid(),
                    offer.getTitle(),
                    offer.getDescription(),
                    offer.getCondition(),
                    offer.getStart(),
                    offer.getEnd());
        }
        else{
            updateOffer(findIDbyUID(offer.getId()),
                    offer.getId(),
                    offer.getUserid(),
                    offer.getTitle(),
                    offer.getDescription(),
                    offer.getCondition(),
                    offer.getStart(),
                    offer.getEnd());
            return offer.getId();
        }
    }

    public boolean deleteOffer(long id){
        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();

        int cntDel = 0;
        try{
            cntDel = dbCon.delete(OfferTbl.TABLE_NAME, OfferTbl.WHERE_ID_EQUALS, new String[] {String.valueOf(id)});
            Log.i(TAG, "Offer mit id = " + id + " geloescht.");
        }finally {
            dbCon.close();
        }
        return cntDel == 1;
    }

    public int deleteAllOffers(){
        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();
        Cursor cur = null;
        int cntDel = 0;
        try{
            cntDel = dbCon.delete(OfferTbl.TABLE_NAME, null, null);;

        }finally {

            dbCon.close();
        }
        Log.i(TAG, "Alle Angebote geloescht."+getRowCount());
        return cntDel;
    }

    public int getRowCount(){
        int cnt = 0;
        final SQLiteDatabase dbCon = udDatabase.getReadableDatabase();
        Cursor cur = null;
        try {
            cur = dbCon.rawQuery(OfferTbl.STMT_COUNT_OFFER, null);

            if (cur.moveToFirst() == false) {
                cnt = 0;
            }
            cnt = cur.getInt(0);
        }finally{
            if(cur != null){
                cur.close();
            }
            dbCon.close();
        }
        return cnt;
    }

    public void openDB() {
        udDatabase.getReadableDatabase();
        Log.d(TAG, "Datenbank OfferDatabase geoeffnet.");
    }

    public void closeDB(){
        udDatabase.close();
        Log.d(TAG, "Datenbank OfferDatabase geschlossen.");
    }

    private long saveOffer(long uid, long userid, String title, String description, String condition, String start, String end){
        final ContentValues data = new ContentValues();
        data.put(OfferTbl.UID, uid);
        data.put(OfferTbl.USERID, userid);
        data.put(OfferTbl.TITLE, title);
        data.put(OfferTbl.DESCRIPTION, description);
        data.put(OfferTbl.CONDITION, condition);
        data.put(OfferTbl.START, start);
        data.put(OfferTbl.END, end);

        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();
        try{
            final long id = dbCon.insertOrThrow(OfferTbl.TABLE_NAME, null, data);
            Log.i(TAG, "Offer mit id = " + id + " erzeugt." );
            return id;
        }
        finally {
            dbCon.close();
        }
    }

    private void updateOffer(long id, long uid, long userid, String title, String description, String condition, String start, String end) {
        if(id == 0){
            Log.w(TAG, "id == 0 => Kein update möglich.");
            return;
        }

        // Daten in den Container abfuellen
        final ContentValues data = new ContentValues();
        data.put(OfferTbl.UID, uid);
        data.put(OfferTbl.USERID, userid);
        data.put(OfferTbl.TITLE, title);
        data.put(OfferTbl.DESCRIPTION, description);
        data.put(OfferTbl.CONDITION, condition);
        data.put(OfferTbl.START, start);
        data.put(OfferTbl.END, end);


        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();
        try {
            dbCon.update(OfferTbl.TABLE_NAME, data, OfferTbl.WHERE_ID_EQUALS, new String[] {String.valueOf(id)});
            Log.i(TAG, "Offer mit id = " + id + " aktualisiert.");
        } finally{
            dbCon.close();
        }
    }

    public long findIDbyUID(long uid) {
        final SQLiteDatabase dbCon = udDatabase.getReadableDatabase();

        Cursor result = dbCon.query(OfferTbl.TABLE_NAME, new String[] {"_id"}, OfferTbl.WHERE_UID_EQUALS, new String[] {String.valueOf(uid)}, null,null,null);
        if(result.getCount()>0) {
            long id = 0;
            while(result.moveToNext()){
                id = result.getLong(0);
                Log.i(TAG, "Angebot mit uid = " + uid + " gefunden (id = "+ id +").");

            }
            return id;
        }else{
            Log.i(TAG, "Kein Angebot mit uid = " + uid + " gefunden.");
            return 0;
        }
    }
}
