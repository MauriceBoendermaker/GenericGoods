using Newtonsoft.Json.Linq;
using System;
using System.Linq;
using System.Collections.Generic;
using System.IO;
using Newtonsoft.Json;
using System.Text.RegularExpressions;
using System.Drawing;
using System.Drawing.Imaging;
using nQuant;

namespace Laptops
{
    class Program
    {
        static void Main(string[] args)
        {
            #region Validate Arguments
            int targNum;
            if (args.Length < 1)
            {
                Console.WriteLine("Please use");
                Console.WriteLine($"{System.AppDomain.CurrentDomain.FriendlyName} [target number of laptops]");
                return;
            }
            if (!int.TryParse(args[0], out targNum)) return;
            if (targNum < 1) return;
            if (!File.Exists("./data.json")) return;
            #endregion

            #region Generate Laptops
            Console.Write("Loading specs (JSON)...");
            string jsonFile = File.ReadAllText("./data.json");
            jsonFile = Regex.Replace(jsonFile, @"\/\/.+", "");
            SpecList dataRoot = JsonConvert.DeserializeObject<SpecList>(jsonFile); // Deserialize our component list
            dataRoot.Process();
            Console.WriteLine(" Done!");

            Console.Write("Generating list of random laptops...");
            LaptopInfo[] laptopList = new LaptopInfo[targNum]; // Laptops will be stored to this array
            Random random = new Random(); // Used to randomly select components for laptop
            for (var i = 0; i < laptopList.Length; i++)
            {
                laptopList[i] = new LaptopInfo(dataRoot, random);
            }
            Console.WriteLine(" Done!");

            LaptopInfo[] laptops = laptopList.Distinct().ToArray();
            Console.WriteLine($"Generated {laptops.Length} unique laptops (removed {targNum - laptops.Length} duplicates)");
            #endregion

            #region Export Generated Laptops
            if (Directory.Exists("./output/")) Directory.Delete("./output/", true);

            Directory.CreateDirectory("./output/");
            Directory.CreateDirectory("./output/images");

            ReadableLaptopInfo[] readableLaptops = new ReadableLaptopInfo[laptops.Length];

            Console.Write("Rendering laptop thumbnails...");
            var quantizer = new WuQuantizer();
            int images = 1;
            for (int i = 0; i < laptops.Length; i++)
            {
                LaptopInfo laptop = laptops[i];
                laptop.thumbnail = $"{images:D8}.png";

                //string brand = dataRoot.brands[laptop.brand].name
                SpecList.Frame frameData = dataRoot.frames[laptop.frameType];
                string frame = frameData.images[laptop.frameIndex];
                string screen = dataRoot.brands[laptop.brand].screens[laptop.screen];
                string keyboard = dataRoot.keyboards[laptop.keyboard];

                Image frameImage = Image.FromFile(Path.Combine(dataRoot.framesPath, frame));
                Image screenImage = Image.FromFile(Path.Combine(dataRoot.screensPath, screen));
                Image keyboardImage = Image.FromFile(Path.Combine(dataRoot.keyboardsPath, keyboard));

                Color thumbColor = ColorTranslator.FromHtml(frameData.colors[random.Next(frameData.colors.Length)]); ;

                Image overlayed = new Bitmap(frameImage.Width, frameImage.Height);
                using (Graphics g = Graphics.FromImage(overlayed))
                {
                    g.Clear(thumbColor);
                    g.DrawImage(frameImage, new Point(0, 0));
                    g.DrawImage(keyboardImage, new Point(0, 0));
                    g.DrawImage(screenImage, new Point(0, 0));
                }

                Bitmap final = new Bitmap(overlayed.Width, overlayed.Height);
                int xoff = random.Next(-20, 20);
                int yoff = random.Next(-10, 1);
                float rot = (float)(random.NextDouble() - 0.5);
                using (Graphics g = Graphics.FromImage(final))
                {
                    g.Clear(Color.White);
                    g.RotateTransform(rot);
                    g.DrawImage(overlayed, xoff, yoff);
                }

                using (var quantized = quantizer.QuantizeImage(final))
                {
                    quantized.Save($"./output/images/{laptop.thumbnail}", ImageFormat.Png);
                }
                images++;

                readableLaptops[i] = new ReadableLaptopInfo(dataRoot, laptop, random);
                readableLaptops[i].GenerateDescription(dataRoot);
            }
            Console.WriteLine(" Done!");

            Console.Write("Exporting laptop list (JSON)...");
            string generatedLaptops = JsonConvert.SerializeObject(readableLaptops, Formatting.Indented);
            File.WriteAllText("./output/list.json", generatedLaptops);
            Console.WriteLine(" Done!");
            #endregion

            #region Convert to database
            Console.Write("Exporting laptop database (SQL)...");
            xmlgenerator xml = new xmlgenerator(readableLaptops, dataRoot);
            File.WriteAllText("./output/database.sql", xml.Generate());
            Console.WriteLine(" Done!");
            #endregion
        }
    }
}
