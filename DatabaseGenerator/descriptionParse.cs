using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace Laptops
{
    static class descriptionParse
    {
        public static string Parse(string text, ReadableLaptopInfo info, SpecList specs)
        {
            string replaced = text.Replace("{brand}", specs.brands[info.brand - 1].name);
            replaced = replaced.Replace("{name}", info.name);
            replaced = replaced.Replace("{inch}", info.screen.diagonal.ToString(CultureInfo.InvariantCulture));
            replaced = replaced.Replace("{gpu}", specs.specs.GPU[info.gpu - 1].name);
            replaced = replaced.Replace("{cpu}", specs.specs.CPU[info.cpu - 1].name);
            replaced = replaced.Replace("{ram}", info.ram.readable);
            replaced = replaced.Replace("{resolution}", specs.specs.Screen.resolutions[info.screen.resolution - 1]);
            replaced = replaced.Replace("{refresh}", info.screen.refresh.ToString());

            /*
            MatchCollection matches = Regex.Matches(replaced, @"\[.*?(?<!\\)\]", RegexOptions.IgnoreCase);

            string output = "";
            int prev = 0;

            for (int match = 0; match < matches.Count; match++)
            {
                string add = matches[match].Value[1..(matches[match].Value.Length - 1)];

                Console.WriteLine(replaced[(prev)..(matches[match].Index)]);

                output += replaced[(prev)..(matches[match].Index)] + add;

                prev = matches[match].Index + matches[match].Length;
            }

            if (prev < text.Length) output += text[prev..text.Length];
            */

            return replaced.Replace("'", "\\'");
        }
    }
}
