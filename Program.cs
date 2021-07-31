using System;

namespace Excercise04
{
    class Program
    {
        static void Main(string[] args)
        {
            Cirle c = new Cirle(2);
            Console.WriteLine(c.Area());
            Rectangle r = new Rectangle(2, 3);
            Console.WriteLine(r.Area());
        }
    }
    public abstract class Shape
    {
        public abstract double Area();
    }
    public class Cirle : Shape
    {
        private double r;
        private double PI = Math.PI;
        public Cirle(double r)
        {
            this.r = r;
        }
        public override double Area()
        {
            Console.WriteLine("Circular area is:");
            return PI * r * r;
        }
    }
    public class Rectangle : Shape
    {
        private double w, h;
        public Rectangle(double w, double h)
        {
            this.w = w;
            this.h = h;
        }
        public override double Area()
        {
            Console.WriteLine("The area of ​​the rectangle is:");
            return w * h;
        }
    }

}