#include <iostream>
#include <stdio.h>
#include <cstdlib>
#include <ctime>
#include <math.h>
#include <random>
#include <conio.h>
#include <string>


using namespace std;

#define PI 3.14159265


int Divide(float numar)
{
	double x = 0;
	int i = 0;;
	while (x < numar)
	{
		x = pow(2, i);
		i++;
	}
	i = i - 1;
	return i;
}


void ShowPop(int pop, int l, int populatie[])
{
	int nr_individ = 1, gene_nr = l;
	for (int i = 0; i < pop; i++)
	{
		if (gene_nr == l)
		{
			cout << endl << "Individul " << nr_individ << ": ";
			nr_individ++;
			gene_nr = 0;
		}
		cout << populatie[i];
		gene_nr++;
	}
}


float GetFitnessIndivid(int nr_individ, int populatie[], int n, int l, int s1, int s2, float a, float b, float a1, float b1)
{
	float fitness;
	int individ_start = nr_individ * l;
	int individ_end = individ_start + (l - 1);
	int s1_decimal = 0, s2_decimal = 0;
	int indexCounter = 0;
	for (int i = individ_start + s1 - 1; i >= individ_start; i--)
	{
		if (populatie[i] == 1)
		{
			s1_decimal += pow(2, indexCounter);
		}
		indexCounter++;
	}

	indexCounter = 0;
	for (int i = individ_end; i >= individ_start + s1; i--)
	{
		if (populatie[i] == 1)
		{
			s2_decimal += pow(2, indexCounter);
		}
		indexCounter++;
	}

	float X1, X2;
	X1 = a + s1_decimal * ((b - a) / (pow(2, s1) - 1));
	X2 = a1 + s2_decimal * ((b1 - a1) / (pow(2, s2) - 1));

	fitness = 21.5 + X1 * sin(4 * PI*X1) + X2 * sin(20 * PI*X2);

	return fitness;
}

float procent(float a, float b)
{
	float result = 0;
	result = ((b - a) * 100) / a;

	return result;
}




int main() {

	int i, j; // interator
	float a, b, a1, b1;
	int n; // Nr de indivizi
	int l; // Lungimea cromoz
	float x1, x2;
	float pc, pm;
	int precizie = 4;
	int D1, D2;
	int s1, s2;
	float F = 0; // Fitness total
	bool rulari = false;



	srand(time(NULL));

	pc = ((double)rand() / RAND_MAX)*(0.95 - 0.2) + 0.2;


	a = -3;
	b = 12.1;
	a1 = 4.1;
	b1 = 5.8;

	float temp;
	if (a > b) {
		temp = b;
		b = a;
		a = temp;
	}
	if (a1 > b1) {
		temp = b1;
		b1 = a1;
		a1 = temp;
	}

	cout << "a1 = " << a << "  b1 = " << b << "  a2 = " << a1 << "  b2 = " << b1 << endl;
	x1 = b - a;
	x2 = b1 - a1;

	cout << endl << "x1 = " << b << " - " << a << " = " << x1 << endl;
	cout << "x2 = " << b1 << " - " << a1 << " = " << x2 << endl;

	D1 = x1 * pow(10, precizie);
	D2 = x2 * pow(10, precizie);

	cout << endl << "D1 =" << x1 << " * " << pow(10, precizie) << "(10 la puterea " << precizie << ") = " << D1 << endl;
	cout << "D2 =" << x2 << " * " << pow(10, precizie) << "(10 la puterea " << precizie << ") = " << D2 << endl;

	s1 = Divide(D1);
	s2 = Divide(D2);

	cout << endl << "s1 = " << "( 2 la puterea " << s1 - 1 << ")" << pow(2, s1 - 1) << " < " << D1 << " < " << pow(2, s1) << "(2 la puterea " << s1 << ") = " << s1 << endl;
	cout << "s2 = " << "( 2 la puterea " << s2 - 1 << ")" << pow(2, s2 - 1) << " < " << D2 << " < " << pow(2, s2) << "(2 la puterea " << s2 << ") = " << s2 << endl;

	l = s1 + s2;
	cout << endl << "l = (s1) " << s1 << " + " << s2 << " (s2) = " << l << endl;
	cout << "Lungimea cromozomului este de " << l << " de gene." << endl;

	// PM 0.1 <-> 0.001
	pm = ((double)rand() / RAND_MAX)*(0.01 - 0.001) + 0.001;
	cout << "PM = " << pm << endl;

	n = 25;
	int pop = n * l; // Nr gene/populatie
	cout << endl << "Populatia este alcatuita din " << n << " indivizi." << endl;

	cout << "Prima generatie:" << endl;



	int *populatie = NULL;
	populatie = new int[pop];
	for (i = 0; i < pop; i++)
	{
		populatie[i] = rand() % 2;
	}

	ShowPop(pop, l, populatie);


	float* v = new float[n];
	float *p = new float[n];
	float *q = new float[n];
	int *inds = new int[n]; //indivizi selectati
	int *indpinc = new int[n];
	int *newpop = new int[pop];
	float *totalfit = new float[6];

	float Ftotalprimagen;
	int individ_start;
	int i2 = 0;
	int individ_start2;
	int r;
	int k1, k2;
	int cut_length;
	int tempp;
	float r_pm;
	int gen = 1;

	while (!rulari)
	{
		F = 0;
		if (gen > 1)
		{
			cout << endl << endl << " Generatia -> " << gen << " <-" << endl;
			ShowPop(pop, l, populatie);
		}

		for (i = 0; i < n; i++)
		{
			v[i] = GetFitnessIndivid(i, populatie, n, l, s1, s2, a, b, a1, b1);
			F += v[i];
		}

		if (gen == 1)
		{
			Ftotalprimagen = F;
		}

		for (i = 0; i < 5; i++)
		{
			totalfit[i] = totalfit[i + 1];
		}
		totalfit[5] = F;


		cout << endl << endl;
		for (i = 0; i < n; i++)
		{
			cout << "Fitness-ul individului " << i + 1 << " " << v[i] << endl;
		}
		cout << endl << "Fitness-ul total F = " << F;

		// Conditie de oprire
		if (gen > 5)
		{
			float fit5gen = 0;
			for (i = 0; i < 5; i++)
			{
				fit5gen = fit5gen + totalfit[i];
			}

			float var = fit5gen / 5;
			float z = F - var;
			if (z < (((F * 5) / 2) / 100) && (z > 0))
			{
				//Cel mai bun candidat
				float max = v[1];
				int counter = 1;
				for (j = 0; j < n; j++)
				{
					if (max < v[j])
					{
						max = v[j];
						counter = j + 1;
					}
				}
				float a2 = Ftotalprimagen;
				float dif2 = F - a2;

				cout << ",a crescut cu " << procent(var, F) << "% fata ultimele 5 generatii" << endl;

				if (dif2 >= 0)
					cout << endl << "si a crescut cu " << procent(a2, F) << "% fata de prima generatia (F = " << a2 << ")" << endl; 

				cout << endl << endl << "Simularea a luat sfarsit!" << endl << "Individul cu fitness-ul cel mai mare este " << counter << ", cu fitness-ul " << max << " din generatia " << gen << endl;
				rulari = true;
				break;
			}

		}



		if (gen > 1)
		{
			float a = totalfit[4];
			float a2 = Ftotalprimagen;
			float dif = F - a;
			float dif2 = F - a2;
			//Diferente fata de gen precedenta
			if (dif >= 0)
				cout << " ,a crescut cu " << procent(a, F) << "% fata de generatia precedenta (F = " << a << ")";
			else
				cout << " ,a scazut cu " << procent(F, a) << "% fata de generatia precedenta (F = " << a << ")";

			//Diferente fata de prima generatie
			if (gen > 2)
			{
				if (dif2 >= 0)
					cout << endl << " ,si a crescut cu " << procent(a2, F) << "% fata de prima generatia (F = " << a2 << ")" << endl;
				else
					cout << endl << " ,si a scazut cu " << procent(F, a2) << "% fata de prima generatia  (F = " << a2 << ")" << endl;
			}


		}
		cout << endl << endl;


		cout << " Selectia indiviziilor ce vor forma noua populatie:" << endl;
		for (i = 0; i < n; i++)
		{
			p[i] = v[i] / F;
			cout << "P" << i + 1 << " = " << p[i] << endl;
		}

		q[0] = p[0];
		for (i = 1; i < n; i++) {
			q[i] = q[i - 1] + p[i];
		}
		cout << endl << "0 ";
		for (i = 0; i < n; i++)
		{
			cout << " " << q[i] << " ";
		}
		cout << endl << endl;

		//Selectia
		for (i = 0; i < n; i++)
		{
			float r = ((double)rand() / RAND_MAX)*(0.95 - 0.2) + 0.2;

			j = 0;
			while (q[j] < r)
			{
				j++;
			}
			float q1 = q[j - 1];
			if (j < 1)
			{
				q1 = 0;
			}
			cout << "q[" << j << "] = " << q1 << " < Nr. aleator = " << r << " < q[" << j + 1 << "] = " << q[j] << " -> Este selectat individul " << j + 1 << endl;
			inds[i] = j;
		}

		i2 = 0;
		for (i = 0; i < n; i++)
		{
			individ_start = inds[i] * l;
			for (j = individ_start; j < individ_start + l; j++)
			{
				newpop[i2] = populatie[j];
				i2++;
			}
		}

		cout << endl << " Populatia selectata:" << endl;
		ShowPop(pop, l, newpop); //Populatia Selectata
		cout << endl;

		cout << endl << "Incrucisarea populatiei:" << endl;


		int n_i = 0;
		for (i = 0; i < n; i++)
		{
			float r2 = (float)rand() / (float)RAND_MAX;
			if (r2 < pc)
			{
				indpinc[n_i] = i;
				n_i++;
			}
		}

		int n2;
		if (n_i % 2 == 0)
			n2 = n_i;
		else
			n2 = n_i - 1;

		// Incrucisarea
		if (n2 < 1)
		{
			cout << endl << "Niciun individ nu a fost selectat pentru incrucisare" << endl;
		}
		for (i = 0; i < n2; i += 2)
		{
			individ_start = indpinc[i] * l;
			individ_start2 = (indpinc[i + 1]) * l;
			r = rand() % (l - 1) + 1;
			cout << endl << " Punctul de taietura pentru individul " << indpinc[i] + 1 << " si individul " << indpinc[i + 1] + 1 << " este " << r << endl;
			k1 = individ_start + r;
			k2 = individ_start2 + r;
			cut_length = l - r;

			for (int g = individ_start; g < individ_start + l; g++)
			{
				cout << newpop[g];
				if (g == ((r - 1) + individ_start))
				{
					cout << " | ";
				}
			}

			cout << endl;

			for (int g = individ_start2; g < individ_start2 + l; g++)
			{
				cout << newpop[g];
				if (g == ((r - 1) + individ_start2))
				{
					cout << " | ";
				}
			}
			cout << endl;

			//Incrucisarea propriu-zisa
			for (j = 0; j < cut_length; j++)
			{
				temp = newpop[k1 + j];
				newpop[k1 + j] = newpop[k2 + j];
				newpop[k2 + j] = temp;
			}

			cout << " Genele cromozomilor dupa incrucisare:" << endl;
			for (int g = individ_start; g < individ_start + l; g++)
			{
				cout << newpop[g];
				if (g == ((r - 1) + individ_start))
				{
					cout << " | ";
				}
			}
			cout << endl;
			for (int g = individ_start2; g < individ_start2 + l; g++)
			{
				cout << newpop[g];
				if (g == ((r - 1) + individ_start2))
				{
					cout << " | ";
				}
			}
			cout << endl;
		}


		//Mutatia
		cout << endl << "Mutatia:" << endl;
		int individ;
		for (i = 0; i < pop; i++)
		{

			r_pm = (float)rand() / (float)RAND_MAX;
			individ = 1;
			if (pm > r_pm)
			{
				int i3 = i;
				while (i3 > l)
				{
					i3 = i3 - l;
					individ++;
				}

				if (newpop[i] == 0)
				{
					newpop[i] = 1;
					cout << "Gena " << i3 + 1 << " a individului " << individ << " a fost modificata (0 -> 1)" << endl;
				}
				else {
					newpop[i] = 0;
					cout << "Gena " << i3 + 1 << " a individului " << individ << " a fost modificata (1 -> 0)" << endl;
				}
			}
		}

		cout << " - " << endl;;

		for (i = 0; i < pop; i++)
		{
			populatie[i] = newpop[i];
		}

		gen++;
	}

	delete[] indpinc;
	delete[] q;
	delete[] p;
	delete[] v;
	delete[] newpop;
	delete[] inds;
	delete[] totalfit;
	delete[] populatie;

	populatie = NULL;


	_getch();
}