/**
 * Created by Yadi on 3/16/18.
 */

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedOutputStream;
import java.io.BufferedWriter;
import java.io.DataOutputStream;
import java.io.InputStream;

        import java.io.BufferedReader;
        import java.io.IOException;
        import java.io.InputStream;
        import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Set;

//        import org.apache.http.HttpEntity;
//        import org.apache.http.HttpResponse;
//        import org.apache.http.NameValuePair;
//        import org.apache.http.client.ClientProtocolException;
//        import org.apache.http.client.entity.UrlEncodedFormEntity;
//        import org.apache.http.client.methods.HttpGet;
//        import org.apache.http.client.methods.HttpPost;
//        import org.apache.http.client.utils.URLEncodedUtils;
//        import org.apache.http.impl.client.DefaultHttpClient;
//        import org.json.JSONException;
//        import org.json.JSONObject;

        import android.util.Log;

import javax.net.ssl.HttpsURLConnection;

public class JSONParser {

    static InputStream is = null;
    static JSONObject postDataParams = null;
    static JSONObject responseParm = null;
    static String json = "";
    HttpURLConnection conn;
    String message = "";

    // constructor
    public JSONParser() {

    }

    // function get json from url
    // by making HTTP POST or GET mehtod
    public JSONObject makeHttpRequest(String stUrl, String method,
                                      HashMap<String,String> params) {

        // Making HTTP request

        try {

//            URL url = new URL("http://13.59.142.19/CampusRunnerBack/api.php/users");
            //turn strint to url
            URL url = new URL("http://13.59.142.19/CampusRunnerBack/yadi_test/TestHiveStuff/create_product.php");
            Log.e("url", "Url: " + url);
            postDataParams = new JSONObject();



//build parameters
            Set keys = params.keySet();

            for (Iterator i = keys.iterator(); i.hasNext(); ) {
                String key = (String) i.next();
                String value = (String) params.get(key);
                postDataParams.put(key, value);
            }

            conn = (HttpURLConnection) url.openConnection();
            conn.setReadTimeout(15000 /* milliseconds */);
            conn.setConnectTimeout(15000 /* milliseconds */);
            conn.setRequestMethod("POST");
            conn.setDoInput(true);
            conn.setDoOutput(true);
            //new
            conn.setRequestProperty("content-type", "application/json");
            conn.setRequestProperty("cache-control", "no-cache");

            //other site stuff
            message = postDataParams.toString();
            conn.setFixedLengthStreamingMode(message.getBytes().length);

/*Previously working
            OutputStream os = conn.getOutputStream();
            BufferedWriter writer = new BufferedWriter(
                    new OutputStreamWriter(os, "UTF-8"));
            writer.write(getPostDataString(postDataParams));
            Log.e("params", postDataParams.toString());
            writer.flush();
            writer.close();
            os.close();
 */
            //open
            conn.connect();

            //setup send
            OutputStream os = new BufferedOutputStream(conn.getOutputStream());
            os.write(message.getBytes());
            //clean up
            os.flush();
            os.close();

            int responseCode = conn.getResponseCode();
            Log.e("responseError", "" + responseCode);

            if (responseCode == HttpsURLConnection.HTTP_OK) {

//                BufferedReader in = new BufferedReader(new InputStreamReader(conn.getInputStream()));
//                StringBuffer sb = new StringBuffer("");
//                String line = "";
//
//                while ((line = in.readLine()) != null) {
//
//                    sb.append(line);
//                    Log.e("Response lines: ", "> " + line);
//                    break;
//                }
//
//                in.close();
//                json = sb.toString();
//                Log.d("buffer", json);

                BufferedReader reader = new BufferedReader(new InputStreamReader(
                        conn.getInputStream()));
                StringBuilder sb = new StringBuilder();
                String line = null;
                while ((line = reader.readLine()) != null) {
                    sb.append(line + "\n");
                }
                reader.close();
                json = sb.toString();

                Log.e("in json string", "Json:  " + json);
                try {
                    responseParm = new JSONObject(json);
                }
                catch(JSONException e){

                    Log.e("JSON Parser", "Error parsing data " + e.toString());
                }
                return responseParm;
            } else {
//                return new String("false : "+responseCode);
                Log.e("responseError", "" + responseCode);

                //postDataParams.getString("status");
                return postDataParams;
                // }
            }
        } catch (Exception e) {
            String error = new String("Exception: " + e.getMessage());
            Log.e("Connection error", "Exception" + e.getMessage());
            //          Log.e("Connection Error 2", conn.getErrorStream().toString());
//            try {
//                postDataParams = new JSONObject(error);
//            }catch (JSONException u){
//                Log.e("JSON Parser", "Error parsing data " + u.toString());
//            }
        }
        return postDataParams;
    }

    public String getPostDataString(JSONObject params) throws Exception {

        StringBuilder result = new StringBuilder();
        boolean first = true;

        Iterator<String> itr = params.keys();

        while(itr.hasNext()){

            String key= itr.next();
            Object value = params.get(key);

            if (first)
                first = false;
            else
                result.append("&");

            result.append(URLEncoder.encode(key, "UTF-8"));
            result.append("=");
            result.append(URLEncoder.encode(value.toString(), "UTF-8"));

        }
        Log.e("result in getpost",result.toString());
        return result.toString();
    }
}


