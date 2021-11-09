using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;

namespace Laptops
{
    class xmlgenerator
    {
        ReadableLaptopInfo[] info { get; }
        SpecList data { get; }

        string newLine { get; } = Environment.NewLine;

        public xmlgenerator(ReadableLaptopInfo[] info, SpecList data)
        {
            this.info = info;
            this.data = data;
        }

        public string Generate()
        {
            string output = "";
            output += System.IO.File.ReadAllText("./header.sql");
            
            output += Info();

            output += System.IO.File.ReadAllText("./footer.sql"); ;

            return FormatXml(output);
        }

        private string Info()
        {
            string o = string.Empty;

            //Brand
            o += newLine + "INSERT INTO `brand` (`id`, `name`) VALUES";
            for (int i = 0; i < data.brands.Length; i++) {
                SpecList.Brand brand = data.brands[i];
                o += newLine +
                    $"({i+1}, '{brand.name}'),";
            }
            o = o.Remove(o.Length - 1, 1) + ";" + newLine;

            //CPU
            o += newLine + "INSERT INTO `cpu` (`id`, `name`, `cores`) VALUES";
            for (int i = 0; i < data.specs.CPU.Length; i++)
            {
                SpecList.Specs.CPUInfo cpu = data.specs.CPU[i];
                o += newLine +
                    $"({i+1}, '{cpu.name}', {cpu.cores}),";
            }
            o = o.Remove(o.Length - 1, 1) + ";" + newLine;

            //GPU
            o += Environment.NewLine + "INSERT INTO `gpu` (`id`, `name`, `vram`) VALUES";
            for (int i = 0; i < data.specs.GPU.Length; i++)
            {
                SpecList.Specs.GPUInfo gpu = data.specs.GPU[i];
                o += newLine +
                    $"({i + 1}, '{gpu.name}', {gpu.vram}),";
            }
            o = o.Remove(o.Length - 1, 1) + ";" + newLine;

            //Laptops
            o += newLine + "INSERT INTO `laptop` (`id`, `name`, `price`, `identifier`, `description`, `brand`, `cpu`, `gpu`, `resolution`, `refreshrate`, `diagonal`, `ram`, `storagetype`, `storagesize`, `thumbnail`) VALUES";
            for (int i = 0; i < info.Length; i++)
            {
                ReadableLaptopInfo laptop = info[i];
                o += newLine +
                    $"({i + 1}, '{laptop.name}', '{laptop.price}.99', '{laptop.identifier}', '{laptop.description}', {laptop.brand}, {laptop.cpu}, {laptop.gpu}, {laptop.screen.resolution}, {laptop.screen.refresh}, '{laptop.screen.diagonal.ToString(System.Globalization.CultureInfo.InvariantCulture)}', '{laptop.ram.readable}', '{laptop.storage.type}', '{laptop.storage.readableSize}', '{laptop.thumbnail}'),";
            }
            o = o.Remove(o.Length - 1, 1) + ";" + newLine;

            //Resolutions
            o += newLine + "INSERT INTO `resolution` (`id`, `resolution`) VALUES";
            for (int i = 0; i < data.specs.Screen.resolutions.Length; i++)
            {
                string res = data.specs.Screen.resolutions[i];
                o += newLine +
                    $"({i + 1}, '{res}'),";
            }
            o = o.Remove(o.Length - 1, 1) + ";" + newLine;

            return o;
        }

        string FormatXml(string xml)
        {
            try
            {
                XDocument doc = XDocument.Parse(xml);
                return doc.ToString();
            }
            catch (Exception)
            {
                // Handle and throw if fatal exception here; don't just ignore them
                return xml;
            }
        }
    }
}
