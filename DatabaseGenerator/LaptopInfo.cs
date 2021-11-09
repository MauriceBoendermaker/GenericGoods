using System;
using System.Collections.Generic;
using System.Diagnostics.CodeAnalysis;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;

namespace Laptops
{
    class LaptopInfo : IEquatable<LaptopInfo>
    {
        public int brand { get; }

        public string name { get; }
        public string description { get; }

        public int frameType { get; }
        public int frameIndex { get; }

        public int screen { get; }
        public int keyboard { get; }
        public float price { get; }

        public Specs specs { get; }

        public string thumbnail { get; set; }

        public class Specs
        {
            public int screenRes { get; set; }
            public int screenRef { get; set; }
            public int screenDiag { get; set; }

            public int ram { get; set; }
            public int cpu { get; set; }
            public int graphicCard { get; set; }

            public int storage { get; set; }
            public int storageType { get; set; }

            public override int GetHashCode()
            {
                return screenRes ^ ram ^ cpu ^ graphicCard ^ storage ^ storageType;
            }
        }

        public LaptopInfo(SpecList specs, Random random)
        {
            brand = random.Next(specs.brands.Length);

            //Name
            name = specs.brands[brand].name[0].ToString().ToUpper();
            foreach(char c in specs.brands[brand].naming)
            {
                switch (c)
                {
                    case '*':
                        name += random.Next(0, 9);
                        break;
                    case '?':
                        name += (char)random.Next('A', 'Z');
                        break;
                    default:
                        name += c;
                        break;
                }
            }
            description = specs.descriptions[random.Next(0, specs.descriptions.Length)];

            //Specs
            this.specs = new Specs();

            this.specs.screenRes = random.Next(specs.specs.Screen.resolutions.Length);
            this.specs.screenRef = random.Next(specs.specs.Screen.hz.Length);
            this.specs.screenDiag = random.Next(specs.specs.Screen.diagonal.Length);

            this.specs.cpu = random.Next(specs.specs.CPU.Length);
            this.specs.ram = random.Next(specs.specs.RAM.Length);

            this.specs.graphicCard = random.Next(specs.specs.GPU.Length);

            this.specs.storageType = random.Next(specs.specs.Drive.types.Length);
            this.specs.storage = random.Next(specs.specs.Drive.sizes.Length);

            //Image
            int frame = random.Next(specs.brands[brand].frames.Length);
            SpecList.FrameIndex index = specs.framesDict[specs.brands[brand].frames[frame]];
            frameType = index.frameType;
            frameIndex = index.frameIndex;

            screen = random.Next(specs.brands[brand].screens.Length);
            keyboard = random.Next(specs.keyboards.Length);

            //Price
            price = random.Next(600, 2000);

        }

        public bool Equals(LaptopInfo other)
        {
            int a = (frameType ^ frameIndex);
            int b = other.frameType ^ other.frameIndex;

            return name.Equals(other.name) || (a == b && keyboard == other.keyboard && brand == other.brand);
        }

        public override int GetHashCode()
        {
            int hashFrame = (frameType ^ frameIndex).GetHashCode();
            int hashKeyboard = keyboard.GetHashCode();
            int hashBrand = brand.GetHashCode();

            return hashFrame ^ hashKeyboard ^ hashBrand & specs.GetHashCode();
        }
    }

    class ReadableLaptopInfo
    {
        //public string brand { get; set; }
        public int brand { get; set; }

        public string name { get; set; }
        public string description { get; set; }
        public string identifier { get; set; }

        public Screen screen { get; set; }
        public RAM ram { get; set; }
        //public CPU cpu { get; set; }
        public int cpu { get; set; }
        //public GPU gpu { get; set; }
        public int gpu { get; set; }

        public float price { get; }

        public Storage storage { get; set; }

        public string thumbnail { get; set; }

        public ReadableLaptopInfo(SpecList specs, LaptopInfo info, Random random)
        {
            //Names
            name = info.name;
            //brand = specs.brands[info.brand].name;
            brand = info.brand + 1;

            identifier = ""; // Regex.Replace(Guid.NewGuid().ToString(), @"[^0-9]", "");

            for (int i = 0; i < 20; i++) identifier += random.Next(0,9);

            //Thumbnail
            thumbnail = info.thumbnail;

            //Screen
            //string res = specs.specs.Screen.resolutions[info.specs.screenRes];
            int res = info.specs.screenRes + 1;
            int @ref = specs.specs.Screen.hz[info.specs.screenRef];
            float diag = specs.specs.Screen.diagonal[info.specs.screenDiag];
            screen = new Screen(res, @ref, diag);

            //CPU
            //SpecList.Specs.CPUInfo CPUInfo = specs.specs.CPU[info.specs.cpu];
            //cpu = new CPU(CPUInfo.name, CPUInfo.cores);
            cpu = info.specs.cpu + 1;

            //GPU
            //SpecList.Specs.GPUInfo GPUInfo = specs.specs.GPU[info.specs.graphicCard];
            //gpu = new GPU(GPUInfo.name, GPUInfo.vram);
            gpu = info.specs.graphicCard + 1;

            //RAM
            ram = new RAM(specs.specs.RAM[info.specs.ram]);

            //Storage
            string driveType = specs.specs.Drive.types[info.specs.storageType];
            int driveSize = specs.specs.Drive.sizes[info.specs.storage];
            storage = new Storage(driveSize, driveType);

            //Price
            price = info.price;

            description = info.description;
        }

        public void GenerateDescription(SpecList specs)
        {
            description = descriptionParse.Parse(description, this, specs);
        }

        public struct Screen
        {
            //public string resolution { get; }
            public int resolution { get; }
            public int refresh { get; }
            public float diagonal { get; }

            //public Screen(string res, int refresh, float diag)
            public Screen(int res, int refresh, float diag)
            {
                resolution = res;
                this.refresh = refresh;
                diagonal = diag;
            }
        }

        public struct RAM
        {
            public int mb { get; }
            public string readable { get; }

            public RAM(int mb)
            {
                this.mb = mb;
                if (mb < 1024)
                {
                    readable = mb + "MB";
                } else
                {
                    readable = Math.Round(mb / 1000d) + "GB";
                }
            }
        }

        public struct GPU
        {
            public string name { get; }
            public string vram { get; }

            public GPU(string name, int vram)
            {
                this.name = name;
                this.vram = vram + "GB";
            }
        }

        public struct CPU
        {
            public string name { get; }
            public int cores { get; }

            public CPU(string name, int cores)
            {
                this.name = name;
                this.cores = cores;
            }
        }

        public struct Storage
        {
            public string type { get; }
            public int size { get; }
            public string readableSize { get; }

            public Storage(int size, string type)
            {
                this.type = type;
                this.size = size;

                if (size < 1000)
                {
                    readableSize = size + "GB";
                }
                else
                {
                    readableSize = Math.Round(size / 1000d) + "TB";
                }
            }
        }
    }
}