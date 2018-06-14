package ch.ffhs.innt.fjdt_3000.urbandiscovery.service;

import android.app.Activity;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Message;
import android.util.Log;

import java.util.List;
import java.util.concurrent.ExecutionException;
import java.util.concurrent.TimeoutException;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.db.OfferSpeicher;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.db.UserSpeicher;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.gui.MainActivity;
import io.swagger.client.api.OfferApi;
import io.swagger.client.api.UserApi;
import io.swagger.client.model.Offer;
import io.swagger.client.model.User;

public class RetrieveUserTask extends AsyncTask<String, Void, User> {
    private static final String TAG = RetriveOffersTask.class.getSimpleName();

    private int userid;
    private UserSpeicher userSpeicher;
    private Context context;

    public RetrieveUserTask(Context context, long userid){
        this.context = context;
        this.userid = (int) userid;
        this.userSpeicher = new UserSpeicher(context);
    }

    @Override
    protected User doInBackground(String... strings) {
        Log.d(TAG, "Start Retrieving");
        UserApi apiInstance = new UserApi();
        User user = null;

        try {
            user = apiInstance.getUserByID(userid);

            Log.d(TAG, user.toString());

        } catch (InterruptedException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        } catch (ExecutionException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        } catch (io.swagger.client.ApiException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        } catch (TimeoutException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        }

        return user;
    }

    protected void onPostExecute(User user) {
        if(user != null) {
           userSpeicher.saveOrUpdateUser(user);
        }
        super.onPostExecute(user);
    }

}
