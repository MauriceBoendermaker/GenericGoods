using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Laptops
{
    [Serializable]
    class SpecList
    {
        public Brand[] brands { get; set; }
        public Frame[] frames { get; set; }
        public string[] keyboards { get; set; }
        public string[] descriptions { get; set; }

        public int frameCount { get; private set; }
        public Dictionary<string, FrameIndex> framesDict { get; private set; } = new Dictionary<string, FrameIndex>();

        public string screensPath { get; set; }
        public string framesPath { get; set; }
        public string keyboardsPath { get; set; }

        public Specs specs { get; set; }

        public void Process()
        {
            //Process frames
            frameCount = 0;
            for (int i = 0; i < frames.Length; i++)
            {
                Frame frame = frames[i];
                frameCount += frame.images.Length;
                for(int x = 0; x < frame.images.Length; x++)
                {
                    framesDict.Add(frame.images[x], new FrameIndex(i, x));
                }
            }
        }

        public FrameIndex GetFrame(int index)
        {
            int cur = 0;
            for(int i = 0; i < frames.Length; i++)
            {
                int length = frames[i].images.Length;
                if (cur -1 + length >= index) return new FrameIndex(i, index - cur);
                cur += length;
            }
            throw new IndexOutOfRangeException();
        }

        [Serializable]
        public class Frame
        {
            public string[] colors { get; set; }
            public string[] images { get; set; }
        }

        [Serializable]
        public class Brand
        {
            public string name { get; set; }
            public string naming { get; set; }

            public string[] frames { get; set; }
            public string[] screens { get; set; }
        }

        [Serializable]
        public class Specs
        {
            public CPUInfo[] CPU { get; set; }
            public GPUInfo[] GPU { get; set; }
            public int[] RAM { get; set; }
            public DriveInfo Drive { get; set; }
            public ScreenInfo Screen { get; set; }

            public struct CPUInfo
            {
                public string name { get; set; }
                public int cores { get; set; }
            }

            public struct GPUInfo
            {
                public string name { get; set; }
                public int vram { get; set; }
            }

            public struct DriveInfo
            {
                public string[] types { get; set; }
                public int[] sizes { get; set; }
            }

            public struct ScreenInfo
            {
                public int[] hz { get; set; }
                public float[] diagonal { get; set; }
                public string[] resolutions { get; set; }
            }
        }

        [Serializable]
        public struct FrameIndex
        {
            public int frameType { get; }
            public int frameIndex { get; }

            public FrameIndex(int type, int index)
            {
                frameType = type;
                frameIndex = index;
            }
        }
    }
}
