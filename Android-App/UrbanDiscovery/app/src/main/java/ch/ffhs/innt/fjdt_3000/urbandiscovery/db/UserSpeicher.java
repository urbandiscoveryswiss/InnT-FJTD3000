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

import io.swagger.client.model.User;


public class UserSpeicher {

    private static final String TAG = "UserSpeicher";

    private UDDatabase udDatabase;

    public UserSpeicher(Context context){
        udDatabase = UDDatabase.getInstance(context);
        openDB();
    }

    @SuppressWarnings("unused")
    public UserSpeicher(){
    }

    public User loadUser(long id) {
        User user = null;
        Cursor c = null;
        try {
            c = udDatabase.getReadableDatabase().query(
                    UserTbl.TABLE_NAME,
                    UserTbl.ALL_COLUMNS,
                    UserTbl.WHERE_ID_EQUALS, new String[] {String.valueOf(id)}, null, null, null);
            if (c.moveToFirst() == false) {
                return null;
            }
            user = loadUser(c);
        } finally {
            if (c != null) {
                c.close();
            }
        }
        return user;
    }

    public User loadUser(Cursor c) {
        final User user = new User();
        user.setId(c.getLong(c.getColumnIndex(UserTbl.UID)));
        user.setUsername(c.getString(c.getColumnIndex(UserTbl.USERNAME)));
        user.setFirstname(c.getString(c.getColumnIndex(UserTbl.FIRSTNAME)));
        user.setName(c.getString(c.getColumnIndex(UserTbl.NAME)));
        user.setAddress(c.getString(c.getColumnIndex(UserTbl.ADDRESS)));
        user.setZip(c.getString(c.getColumnIndex(UserTbl.ZIP)));
        user.setCity(c.getString(c.getColumnIndex(UserTbl.CITY)));
        user.setCoordinates(c.getString(c.getColumnIndex(UserTbl.COORDINATES)));
        user.setEmail(c.getString(c.getColumnIndex(UserTbl.EMAIL)));

        return user;

    }

    public Cursor loadUserList(){
        final SQLiteQueryBuilder userSearch =  new SQLiteQueryBuilder();
        userSearch.setTables(UserTbl.TABLE_NAME);

        return userSearch.query(udDatabase.getReadableDatabase(),
                UserTbl.ALL_COLUMNS,
                null,
                null,
                null,
                null,
                UserTbl.DEFAULT_SORT_ORDER);
    }



    public List<User> getUserList(){
        List<User> userList = new ArrayList<User>();
        Cursor cur = loadUserList();
        if (cur.moveToFirst()){
            do{
                User user = loadUser(cur);
                userList.add(user);
            }while(cur.moveToNext());
        }
        return userList;
    }

    public long saveOrUpdateUser(User user){
        if(findIDbyUID(user.getId()) == 0){
            return saveUser(user.getId(),
                    user.getUsername(),
                    user.getFirstname(),
                    user.getName(),
                    user.getAddress(),
                    user.getZip(),
                    user.getCity(),
                    user.getCoordinates(),
                    user.getEmail());
        }
        else{
            updateUser(findIDbyUID(user.getId()),
                    user.getId(),
                    user.getUsername(),
                    user.getFirstname(),
                    user.getName(),
                    user.getAddress(),
                    user.getZip(),
                    user.getCity(),
                    user.getCoordinates(),
                    user.getEmail());
            return user.getId();
        }
    }

    public boolean deleteUser(long id){
        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();

        int cntDel = 0;
        try{
            cntDel = dbCon.delete(UserTbl.TABLE_NAME, UserTbl.WHERE_ID_EQUALS, new String[] {String.valueOf(id)});
            Log.i(TAG, "User mit id = " + id + " geloescht.");
        }finally {
            dbCon.close();
        }
        return cntDel == 1;
    }

    public int getRowCount(){
        int cnt = 0;
        final SQLiteDatabase dbCon = udDatabase.getReadableDatabase();
        Cursor cur = null;
        try {
            cur = dbCon.rawQuery(UserTbl.STMT_COUNT_USER, null);

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
        Log.d(TAG, "Datenbank UserDatabase geoeffnet.");
    }

    public void closeDB(){
        udDatabase.close();
        Log.d(TAG, "Datenbank UserDatabase geschlossen.");
    }

    private long saveUser(long uid, String username, String firstname, String name, String address, String zip, String city, String coordinates, String email){
        final ContentValues data = new ContentValues();
        data.put(UserTbl.UID, uid);
        data.put(UserTbl.USERNAME, username);
        data.put(UserTbl.FIRSTNAME, firstname);
        data.put(UserTbl.NAME, name);
        data.put(UserTbl.ADDRESS, address);
        data.put(UserTbl.ZIP, zip);
        data.put(UserTbl.CITY, city);
        data.put(UserTbl.COORDINATES, coordinates);
        data.put(UserTbl.EMAIL, email);

        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();
        try{
            final long id = dbCon.insertOrThrow(UserTbl.TABLE_NAME, null, data);
            Log.i(TAG, "User mit id = " + id + " erzeugt." );
            return id;
        }
        finally {
            dbCon.close();
        }
    }

    private void updateUser(long id, long uid, String username, String firstname, String name, String address, String zip, String city, String coordinates, String email) {
        if(id == 0){
            Log.w(TAG, "id == 0 => Kein update möglich.");
            return;
        }

        // Daten in den Container abfuellen
        final ContentValues data = new ContentValues();
        data.put(UserTbl.UID, uid);
        data.put(UserTbl.USERNAME, username);
        data.put(UserTbl.FIRSTNAME, firstname);
        data.put(UserTbl.NAME, name);
        data.put(UserTbl.ADDRESS, address);
        data.put(UserTbl.ZIP, zip);
        data.put(UserTbl.CITY, city);
        data.put(UserTbl.COORDINATES, coordinates);
        data.put(UserTbl.EMAIL, email);


        final SQLiteDatabase dbCon = udDatabase.getWritableDatabase();
        try {
            dbCon.update(UserTbl.TABLE_NAME, data, UserTbl.WHERE_ID_EQUALS, new String[] {String.valueOf(id)});
            Log.i(TAG, "User mit id = " + id + " aktualisiert.");
        } finally{
            dbCon.close();
        }
    }

    public long findIDbyUID(long uid) {
        final SQLiteDatabase dbCon = udDatabase.getReadableDatabase();

        Cursor result = dbCon.query(UserTbl.TABLE_NAME, new String[] {"_id"}, UserTbl.WHERE_UID_EQUALS, new String[] {String.valueOf(uid)}, null,null,null);
        if(result.getCount()>0) {
            long id = 0;
            while(result.moveToNext()){
                id = result.getLong(0);
                Log.i(TAG, "Benutzer mit uid = " + uid + " gefunden (id = "+ id +").");

            }
            return id;
        }else{
            Log.i(TAG, "Kein Benutzer mit uid = " + uid + " gefunden.");
            return 0;
        }
    }
}
